<?php

namespace App\Http\Requests\Address;

use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class AddressStoreRequest extends FormRequest implements StoreRequestInterface
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'additional_details' => 'nullable|string|max:255',
            'zipcode' => 'required|string|max:10',
            'neighborhood' => 'required|string|max:50',
            'city' => 'required|string|max:30',
            'state' => 'required|string|max:30',
            'country' => 'required|string|max:30',
        ];
    }
}
