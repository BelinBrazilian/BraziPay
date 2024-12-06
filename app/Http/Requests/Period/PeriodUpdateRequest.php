<?php

namespace App\Http\Requests\Period;

use App\Http\Interfaces\UpdateRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class PeriodUpdateRequest extends FormRequest  implements UpdateRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'external_id' => 'nullable|integer',
            'subscription_id' => 'required|exists:subscriptions,id',
            'billing_at' => 'required|date',
            'cycle' => 'required|integer',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'duration' => 'required|integer',
        ];
    }
}
