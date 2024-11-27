<?php

namespace App\Http\Requests\Affiliates;

use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class AffiliateStoreRequest extends FormRequest implements StoreRequestInterface
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
            'login' => 'required|string|unique:affiliates,login|max:255',
            'status' => 'required|integer',
            'enabled' => 'required|string|max:255',
        ];
    }
}
