<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [ 
            'name' => 'required|string|max:50', 
            'email' => [ 
                'required', 
                'string', 
                'email', 
                'max:50', 
                Rule::unique('customers')->ignore($this->route('customer')), 
            ], 
            'registry_code' => 'nullable|string|max:20', 
            'code' => 'required|uuid', 
            'notes' => 'nullable|string', 
            'metadata' => 'nullable|string', 
            'address_id' => 'nullable|exists:addresses,id',
        ];
    }

    public function getAddressFields(): array
    {
        return $this->input('address', []);
    }

    public function getPhoneFields(): array
    {
        return $this->input('phones', []);
    }
}
