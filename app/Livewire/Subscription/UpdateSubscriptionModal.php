<?php

namespace App\Livewire\Subscription;

use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateSubscriptionModal extends Component
{
    public $subscription_id;

    public $plan_id;

    public $customer_id;

    public $payment_method_id;

    public $payment_profile_id;

    public $code;

    public $start_at;

    public $installments;

    public $billing_trigger_type;

    public $billing_trigger_day;

    public $billing_cycles;

    public $invoice_split;

    public $metadata;

    protected $rules = [
        'plan_id' => 'required|exists:plans,id',
        'customer_id' => 'required|exists:customers,id',
        'payment_method_id' => 'required|exists:payment_methods,id',
        'payment_profile_id' => 'nullable|exists:payment_profiles,id',
        'code' => 'nullable|string|max:255|unique:subscriptions,code,{id}',
        'start_at' => 'required|date',
        'installments' => 'nullable|integer|min:1',
        'billing_trigger_type' => 'nullable|string|max:255',
        'billing_trigger_day' => 'nullable|integer|min:1|max:31',
        'billing_cycles' => 'nullable|integer|min:1',
        'invoice_split' => 'nullable|integer|min:1',
        'metadata' => 'nullable|json',
    ];

    protected $listeners = ['modal.show.subscription' => 'loadSubscription'];

    public function render()
    {
        return view('livewire.subscriptions.update-subscription-modal');
    }

    public function resetFields()
    {
        $this->subscription_id = null;
        $this->plan_id = null;
        $this->customer_id = null;
        $this->payment_method_id = null;
        $this->payment_profile_id = null;
        $this->code = null;
        $this->start_at = null;
        $this->installments = null;
        $this->billing_trigger_type = null;
        $this->billing_trigger_day = null;
        $this->billing_cycles = null;
        $this->invoice_split = null;
        $this->metadata = null;
    }

    public function loadSubscription($subscription_id)
    {
        $subscription = Subscription::find($subscription_id);

        if (! $subscription) {
            $this->dispatch('error', 'Subscription not found.');

            return;
        }

        $this->subscription_id = $subscription->id;
        $this->plan_id = $subscription->plan_id;
        $this->customer_id = $subscription->customer_id;
        $this->payment_method_id = $subscription->payment_method_id;
        $this->payment_profile_id = $subscription->payment_profile_id;
        $this->code = $subscription->code;
        $this->start_at = $subscription->start_at->toDateString();
        $this->installments = $subscription->installments;
        $this->billing_trigger_type = $subscription->billing_trigger_type;
        $this->billing_trigger_day = $subscription->billing_trigger_day;
        $this->billing_cycles = $subscription->billing_cycles;
        $this->invoice_split = $subscription->invoice_split;
        $this->metadata = json_encode($subscription->metadata);
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $subscription = Subscription::find($this->subscription_id);

            if (! $subscription) {
                $this->dispatch('error', 'Subscription not found.');

                return;
            }

            $subscription->update([
                'plan_id' => $this->plan_id,
                'customer_id' => $this->customer_id,
                'payment_method_id' => $this->payment_method_id,
                'payment_profile_id' => $this->payment_profile_id,
                'code' => $this->code,
                'start_at' => $this->start_at,
                'installments' => $this->installments,
                'billing_trigger_type' => $this->billing_trigger_type,
                'billing_trigger_day' => $this->billing_trigger_day,
                'billing_cycles' => $this->billing_cycles,
                'invoice_split' => $this->invoice_split,
                'metadata' => $this->metadata ? json_decode($this->metadata, true) : null,
            ]);
        });

        $this->dispatch('success', 'Subscription updated successfully.');
        $this->emit('refreshSubscriptions');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
