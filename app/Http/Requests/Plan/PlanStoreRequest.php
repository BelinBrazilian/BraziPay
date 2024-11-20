<?php

namespace App\Http\Requests\Plan;

use App\Http\Enums\PlanBillingTriggerTypeEnum;
use App\Http\Enums\PlanIntervalEnum;
use App\Http\Enums\PlanStatusEnum;
use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanStoreRequest extends FormRequest implements StoreRequestInterface
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
            'name' => 'required|string|max:255', 
            'interval' => ['required', Rule::in(PlanIntervalEnum::cases())], 
            'interval_count' => 'required|integer|min:1', 
            'billing_trigger_type' => ['required', Rule::in(PlanBillingTriggerTypeEnum::cases())], 
            'billing_trigger_day' => 'required|integer|min:1|max:31', 
            'billing_cycles' => 'nullable|integer|min:1', 
            'description' => 'nullable|string', 
            'installments' => 'required|integer|min:1', 
            'invoice_split' => 'nullable|string|max:255', 
            'status' => ['required', Rule::in(PlanStatusEnum::cases())], 
            'metadata' => 'nullable|string',
        ];
    }

    public function getPlanItemFields(): array
    {
        return $this->input('plan_item', []);
    }
}
