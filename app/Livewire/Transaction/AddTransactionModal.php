<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class AddTransactionModal extends Component
{
    public $charge_id;
    public $payment_method_id;
    public $amount;
    public $paid_at;
    public $comments;

    protected $rules = [
        'charge_id' => 'required|string|max:255',
        'payment_method_id' => 'required|exists:payment_methods,id',
        'amount' => 'required|numeric|min:0.01',
        'paid_at' => 'nullable|date',
        'comments' => 'nullable|string|max:1000',
    ];

    public function render()
    {
        return view('livewire.transaction.add-transaction-modal');
    }

    public function resetFields()
    {
        $this->charge_id = null;
        $this->payment_method_id = null;
        $this->amount = null;
        $this->paid_at = null;
        $this->comments = null;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            Transaction::create([
                'charge_id' => $this->charge_id,
                'payment_method_id' => $this->payment_method_id,
                'amount' => $this->amount,
                'paid_at' => $this->paid_at,
                'comments' => $this->comments,
            ]);
        });

        $this->dispatch('success', 'Transaction added successfully.');
        $this->resetFields();
        $this->emit('refreshTransactions');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
