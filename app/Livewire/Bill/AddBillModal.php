<?php

namespace App\Livewire\Bill;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class AddBillModal extends Component
{
    use WithFileUploads;

    public $customer_id;
    public $payment_method_id;
    public $code;
    public $billing_at;
    public $due_at;
    public $brand_tid;

    public $customers;
    public $payment_methods;

    protected $rules = [
        'customer_id' => 'required|exists:customers,id',
        'payment_method_id' => 'required|exists:payment_methods,id',
        'code' => 'required|string|max:255',
        'billing_at' => 'required|date',
        'due_at' => 'required|date|after_or_equal:billing_at',
        'brand_tid' => 'nullable|string|max:255',
    ];

    protected $listeners = [
        'modal.show.add_bill' => 'initialize',
    ];

    public function mount(): void
    {
        $this->customers = Customer::all();
        $this->payment_methods = PaymentMethod::all();
        $this->resetFields();
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.bills.add-bill-modal');
    }

    public function resetFields(): void
    {
        $this->customer_id = null;
        $this->payment_method_id = null;
        $this->code = null;
        $this->billing_at = null;
        $this->due_at = null;
        $this->brand_tid = null;
    }

    public function initialize(): void
    {
        $this->resetFields();
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction(function () {
            $data = [
                'customer_id' => $this->customer_id,
                'payment_method_id' => $this->payment_method_id,
                'code' => $this->code,
                'billing_at' => $this->billing_at,
                'due_at' => $this->due_at,
                'brand_tid' => $this->brand_tid,
            ];

            Bill::create($data);

            $this->dispatch('success', 'Bill created successfully.');
        });

        $this->resetFields();
        $this->emit('refreshBills');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
