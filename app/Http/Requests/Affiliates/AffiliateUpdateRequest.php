<?php

namespace App\Http\Requests\Affiliates;

use App\Http\Interfaces\UpdateRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class AffiliateUpdateRequest extends FormRequest implements UpdateRequestInterface
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
            'login' => 'sometimes|required|string|unique:affiliates,login,'.$this->route('affiliate')->id.'|max:255',
            'status' => 'sometimes|required|integer',
            'enabled' => 'sometimes|required|string|max:255',
        ];
    }
}
