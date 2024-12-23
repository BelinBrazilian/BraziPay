<?php

namespace App\Livewire\Subscription;

use Livewire\Component;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class AddSubscriptionModal extends Component
{
    public $plan_id;
    public $customer_id;
    public $payment_method_id;
    public $code;
    public $start_at;
    public $installments;
    public $billing_trigger_type;
    public $invoice_split;
    public $metadata;

    protected $rules = [
        'plan_id' => 'required|exists:plans,id',
        'customer_id' => 'required|exists:customers,id',
        'payment_method_id' => 'required|exists:payment_methods,id',
        'code' => 'nullable|string|max:255|unique:subscriptions,code',
        'start_at' => 'required|date',
        'installments' => 'nullable|integer|min:1',
        'billing_trigger_type' => 'nullable|string|max:255',
        'invoice_split' => 'nullable|integer|min:1',
        'metadata' => 'nullable|json',
    ];

    public function render()
    {
        return view('livewire.subscriptions.add-subscription-modal');
    }

    public function resetFields()
    {
        $this->plan_id = null;
        $this->customer_id = null;
        $this->payment_method_id = null;
        $this->code = null;
        $this->start_at = null;
        $this->installments = null;
        $this->billing_trigger_type = null;
        $this->invoice_split = null;
        $this->metadata = null;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            Subscription::create([
                'plan_id' => $this->plan_id,
                'customer_id' => $this->customer_id,
                'payment_method_id' => $this->payment_method_id,
                'code' => $this->code,
                'start_at' => $this->start_at,
                'installments' => $this->installments,
                'billing_trigger_type' => $this->billing_trigger_type,
                'invoice_split' => $this->invoice_split,
                'metadata' => $this->metadata ? json_decode($this->metadata, true) : null,
            ]);
        });

        $this->dispatch('success', 'Subscription added successfully.');
        $this->resetFields();
        $this->emit('refreshSubscriptions');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
