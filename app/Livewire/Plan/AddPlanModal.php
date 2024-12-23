<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddPlanModal extends Component
{
    public $code;

    public $name;

    public $interval;

    public $interval_count;

    public $description;

    public $installments;

    public $invoice_split;

    public $status;

    public $metadata;

    protected $rules = [
        'code' => 'required|string|max:255|unique:plans,code',
        'name' => 'required|string|max:255',
        'interval' => 'required|in:daily,weekly,monthly,yearly',
        'interval_count' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'installments' => 'nullable|integer|min:0',
        'invoice_split' => 'nullable|integer|min:0',
        'status' => 'required|in:active,inactive',
        'metadata' => 'nullable|json',
    ];

    public function render()
    {
        return view('livewire.plans.add-plan-modal');
    }

    public function resetFields()
    {
        $this->code = null;
        $this->name = null;
        $this->interval = null;
        $this->interval_count = null;
        $this->description = null;
        $this->installments = null;
        $this->invoice_split = null;
        $this->status = null;
        $this->metadata = null;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            Plan::create([
                'code' => $this->code,
                'name' => $this->name,
                'interval' => $this->interval,
                'interval_count' => $this->interval_count,
                'description' => $this->description,
                'installments' => $this->installments,
                'invoice_split' => $this->invoice_split,
                'status' => $this->status,
                'metadata' => $this->metadata ? json_decode($this->metadata, true) : null,
            ]);
        });

        $this->dispatch('success', 'Plan added successfully.');
        $this->resetFields();
        $this->emit('refreshPlans');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
