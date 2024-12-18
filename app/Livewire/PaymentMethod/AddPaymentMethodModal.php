<?php

namespace App\Livewire\PaymentMethod;

use Livewire\Component;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class AddPaymentMethodModal extends Component
{
    public $public_name;
    public $name;
    public $code;
    public $type;
    public $status;
    public $settings;
    public $maximum_attempts;

    protected $rules = [
        'public_name' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:255|unique:payment_methods,code',
        'type' => 'required|in:credit_card,debit_card,bank_transfer',
        'status' => 'required|in:active,inactive',
        'settings' => 'nullable|json',
        'maximum_attempts' => 'nullable|integer|min:0',
    ];

    public function render()
    {
        return view('livewire.payment-methods.add-payment-method-modal');
    }

    public function resetFields()
    {
        $this->public_name = null;
        $this->name = null;
        $this->code = null;
        $this->type = null;
        $this->status = null;
        $this->settings = null;
        $this->maximum_attempts = null;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            PaymentMethod::create([
                'public_name' => $this->public_name,
                'name' => $this->name,
                'code' => $this->code,
                'type' => $this->type,
                'status' => $this->status,
                'settings' => $this->settings ? json_decode($this->settings, true) : null,
                'maximum_attempts' => $this->maximum_attempts,
            ]);
        });

        $this->dispatch('success', 'Payment Method added successfully.');
        $this->resetFields();
        $this->emit('refreshPaymentMethods');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
