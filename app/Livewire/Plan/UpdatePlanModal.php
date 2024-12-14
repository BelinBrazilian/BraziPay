<?php

namespace App\Livewire\Plan;

use Livewire\Component;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class UpdatePlanModal extends Component
{
    public $plan_id;
    public $code;
    public $name;
    public $interval;
    public $interval_count;
    public $billing_trigger_type;
    public $billing_trigger_day;
    public $billing_cycles;
    public $description;
    public $installments;
    public $invoice_split;
    public $status;
    public $metadata;

    protected $rules = [
        'code' => 'required|string|max:255|unique:plans,code,{id}',
        'name' => 'required|string|max:255',
        'interval' => 'required|in:daily,weekly,monthly,yearly',
        'interval_count' => 'required|integer|min:1',
        'billing_trigger_type' => 'required|string|max:255',
        'billing_trigger_day' => 'required|integer|min:0',
        'billing_cycles' => 'nullable|integer|min:0',
        'description' => 'nullable|string',
        'installments' => 'nullable|integer|min:0',
        'invoice_split' => 'nullable|integer|min:0',
        'status' => 'required|in:active,inactive',
        'metadata' => 'nullable|json',
    ];

    protected $listeners = ['modal.show.update_plan' => 'loadPlan'];

    public function render()
    {
        return view('livewire.plan.update-plan-modal');
    }

    public function resetFields()
    {
        $this->plan_id = null;
        $this->code = null;
        $this->name = null;
        $this->interval = null;
        $this->interval_count = null;
        $this->billing_trigger_type = null;
        $this->billing_trigger_day = null;
        $this->billing_cycles = null;
        $this->description = null;
        $this->installments = null;
        $this->invoice_split = null;
        $this->status = null;
        $this->metadata = null;
    }

    public function loadPlan($plan_id)
    {
        $plan = Plan::find($plan_id);

        if (!$plan) {
            $this->dispatch('error', 'Plan not found.');
            return;
        }

        $this->plan_id = $plan->id;
        $this->code = $plan->code;
        $this->name = $plan->name;
        $this->interval = $plan->interval;
        $this->interval_count = $plan->interval_count;
        $this->billing_trigger_type = $plan->billing_trigger_type;
        $this->billing_trigger_day = $plan->billing_trigger_day;
        $this->billing_cycles = $plan->billing_cycles;
        $this->description = $plan->description;
        $this->installments = $plan->installments;
        $this->invoice_split = $plan->invoice_split;
        $this->status = $plan->status;
        $this->metadata = json_encode($plan->metadata);
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $plan = Plan::find($this->plan_id);

            if (!$plan) {
                $this->dispatch('error', 'Plan not found.');
                return;
            }

            $plan->update([
                'code' => $this->code,
                'name' => $this->name,
                'interval' => $this->interval,
                'interval_count' => $this->interval_count,
                'billing_trigger_type' => $this->billing_trigger_type,
                'billing_trigger_day' => $this->billing_trigger_day,
                'billing_cycles' => $this->billing_cycles,
                'description' => $this->description,
                'installments' => $this->installments,
                'invoice_split' => $this->invoice_split,
                'status' => $this->status,
                'metadata' => $this->metadata ? json_decode($this->metadata, true) : null,
            ]);
        });

        $this->dispatch('success', 'Plan updated successfully.');
        $this->emit('refreshPlans');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
