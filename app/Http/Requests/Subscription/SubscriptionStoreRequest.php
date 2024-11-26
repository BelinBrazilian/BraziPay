<?php

namespace App\Http\Requests;

use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionStoreRequest extends FormRequest implements StoreRequestInterface

{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true; // Ou sua lógica de autorização aqui
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        return [
            'plan_id' => 'required|exists:plans,id',
            'customer_id' => 'required|exists:customers,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_profile_id' => 'required|exists:payment_profiles,id',
            'external_id' => 'nullable|integer',
            'code' => 'required|uuid|unique:subscriptions,code', 
            'start_at' => 'nullable|date',
            'installments' => 'nullable|integer',
            'billing_trigger_type' => 'nullable|string',
            'billing_trigger_day' => 'nullable|integer',
            'billing_cycles' => 'nullable|integer',
            'invoice_split' => 'nullable|boolean',
        ];
    }
}
