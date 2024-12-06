<?php

namespace App\Http\Requests\Discount;

use App\Http\Enums\DiscountTypeEnum;
use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountStoreRequest extends FormRequest implements StoreRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'external_id' => 'nullable|integer',
            'product_item_id' => 'required|integer|exists:product_items,id',
            'discount_type' => ['required', Rule::in(DiscountTypeEnum::cases())],
            'percentage' => 'nullable|numeric|min:0.01|max:100',
            'amount' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'cycles' => 'nullable|integer',
        ];
    }
}
