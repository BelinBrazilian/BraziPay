<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\PaymentMethod;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateBillModal extends Component
{
    public $bill_id;

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
        'modal.show.edit_bill' => 'loadBill',
    ];

    public function mount(): void
    {
        $this->customers = Customer::all();
        $this->payment_methods = PaymentMethod::all();
        $this->resetFields();
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.bills.update-bill-modal');
    }

    public function resetFields(): void
    {
        $this->bill_id = null;
        $this->customer_id = null;
        $this->payment_method_id = null;
        $this->code = null;
        $this->billing_at = null;
        $this->due_at = null;
        $this->brand_tid = null;
    }

    public function loadBill($bill_id): void
    {
        $bill = Bill::find($bill_id);

        if (! $bill) {
            $this->dispatch('error', 'Bill not found.');

            return;
        }

        $this->bill_id = $bill->id;
        $this->customer_id = $bill->customer_id;
        $this->payment_method_id = $bill->payment_method_id;
        $this->code = $bill->code;
        $this->billing_at = $bill->billing_at;
        $this->due_at = $bill->due_at;
        $this->brand_tid = $bill->brand_tid;
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction(function () {
            $bill = Bill::find($this->bill_id);

            if (! $bill) {
                $this->dispatch('error', 'Bill not found.');

                return;
            }

            $bill->update([
                'customer_id' => $this->customer_id,
                'payment_method_id' => $this->payment_method_id,
                'code' => $this->code,
                'billing_at' => $this->billing_at,
                'due_at' => $this->due_at,
                'brand_tid' => $this->brand_tid,
            ]);

            $this->dispatch('success', 'Bill updated successfully.');
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
