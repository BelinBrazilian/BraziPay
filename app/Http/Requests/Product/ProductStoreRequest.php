<?php

namespace App\Http\Requests\Product;

use App\Http\Enums\ProductInvoiceEnum;
use App\Http\Enums\ProductStatusEnum;
use App\Http\Enums\SchemaTypeEnum;
use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest implements StoreRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'string|max:255|unique:products,code',
            'unit' => 'string|max:255',
            'status' => ['required', Rule::in(ProductStatusEnum::cases())],
            'description' => 'string',
            'invoice' => ['required', Rule::in(ProductInvoiceEnum::cases())],

            'pricing_schema' => 'array',
            'pricing_schema.*.price' => 'required|numeric',
            'pricing_schema.*.minimum_price' => 'numeric',
            'pricing_schema.*.schema_type' => ['required', Rule::in(SchemaTypeEnum::cases())],

            'pricing_schema.*.pricing_ranges' => 'array',
            'pricing_schema.*.pricing_ranges.*.start_quantity' => 'required|numeric',
            'pricing_schema.*.pricing_ranges.*.end_quantity' => 'numeric',
            'pricing_schema.*.pricing_ranges.*.price' => 'required|numeric',
            'pricing_schema.*.pricing_ranges.*.overage_price' => 'numeric',

            'pricing_schema.metadata' => 'string',
        ];
    }
}
