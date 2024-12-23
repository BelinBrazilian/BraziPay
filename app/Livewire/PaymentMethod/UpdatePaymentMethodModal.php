<?php

namespace App\Livewire\PaymentMethod;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdatePaymentMethodModal extends Component
{
    public $payment_method_id;

    public $public_name;

    public $name;

    public $code;

    public $type;

    public $status;

    public $settings;

    public $set_subscription_on_success;

    public $allow_as_alternative;

    public $maximum_attempts;

    protected $rules = [
        'public_name' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:255|unique:payment_methods,code,{id}',
        'type' => 'required|in:credit_card,debit_card,bank_transfer',
        'status' => 'required|in:active,inactive',
        'settings' => 'nullable|json',
        'set_subscription_on_success' => 'nullable|boolean',
        'allow_as_alternative' => 'nullable|boolean',
        'maximum_attempts' => 'nullable|integer|min:0',
    ];

    protected $listeners = ['modal.show.update_payment_method' => 'loadPaymentMethod'];

    public function render()
    {
        return view('livewire.payment-methods.update-payment-method-modal');
    }

    public function resetFields()
    {
        $this->payment_method_id = null;
        $this->public_name = null;
        $this->name = null;
        $this->code = null;
        $this->type = null;
        $this->status = null;
        $this->settings = null;
        $this->set_subscription_on_success = null;
        $this->allow_as_alternative = null;
        $this->maximum_attempts = null;
    }

    public function loadPaymentMethod($payment_method_id)
    {
        $paymentMethod = PaymentMethod::find($payment_method_id);

        if (! $paymentMethod) {
            $this->dispatch('error', 'Payment Method not found.');

            return;
        }

        $this->payment_method_id = $paymentMethod->id;
        $this->public_name = $paymentMethod->public_name;
        $this->name = $paymentMethod->name;
        $this->code = $paymentMethod->code;
        $this->type = $paymentMethod->type;
        $this->status = $paymentMethod->status;
        $this->settings = json_encode($paymentMethod->settings);
        $this->set_subscription_on_success = $paymentMethod->set_subscription_on_success;
        $this->allow_as_alternative = $paymentMethod->allow_as_alternative;
        $this->maximum_attempts = $paymentMethod->maximum_attempts;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $paymentMethod = PaymentMethod::find($this->payment_method_id);

            if (! $paymentMethod) {
                $this->dispatch('error', 'Payment Method not found.');

                return;
            }

            $paymentMethod->update([
                'public_name' => $this->public_name,
                'name' => $this->name,
                'code' => $this->code,
                'type' => $this->type,
                'status' => $this->status,
                'settings' => $this->settings ? json_decode($this->settings, true) : null,
                'set_subscription_on_success' => $this->set_subscription_on_success,
                'allow_as_alternative' => $this->allow_as_alternative,
                'maximum_attempts' => $this->maximum_attempts,
            ]);
        });

        $this->dispatch('success', 'Payment Method updated successfully.');
        $this->emit('refreshPaymentMethods');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
