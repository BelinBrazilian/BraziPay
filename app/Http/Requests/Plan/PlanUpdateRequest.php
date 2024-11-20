<?php

namespace App\Http\Requests\Plan;

use App\Http\Enums\PlanBillingTriggerTypeEnum;
use App\Http\Enums\PlanIntervalEnum;
use App\Http\Enums\PlanStatusEnum;
use App\Http\Interfaces\UpdateRequestInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanUpdateRequest extends FormRequest implements UpdateRequestInterface
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
            'name' => 'sometimes|required|string|max:255',
            'interval' => ['sometimes', 'required', Rule::in(PlanIntervalEnum::cases())],
            'interval_count' => 'sometimes|required|integer|min:1',
            'billing_trigger_type' => ['sometimes', 'required', Rule::in(PlanBillingTriggerTypeEnum::cases())],
            'billing_trigger_day' => 'sometimes|required|integer|min:1|max:31',
            'billing_cycles' => 'sometimes|nullable|integer|min:1',
            'description' => 'sometimes|nullable|string',
            'installments' => 'sometimes|required|integer|min:1',
            'invoice_split' => 'sometimes|nullable|string|max:255',
            'status' => ['sometimes', 'required', Rule::in(PlanStatusEnum::cases())],
            'metadata' => 'sometimes|nullable|string',
        ];
    }

    public function getPlanItemFields(): array
    {
        return $this->input('plan_item', []);
    }
}
