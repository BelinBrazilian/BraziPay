<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class UpdateTransactionModal extends Component
{
    public $transaction_id;
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

    protected $listeners = ['modal.show.transaction' => 'loadTransaction'];

    public function render()
    {
        return view('livewire.transactions.update-transaction-modal');
    }

    public function resetFields()
    {
        $this->transaction_id = null;
        $this->charge_id = null;
        $this->payment_method_id = null;
        $this->amount = null;
        $this->paid_at = null;
        $this->comments = null;
    }

    public function loadTransaction($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);

        if (!$transaction) {
            $this->dispatch('error', 'Transaction not found.');
            return;
        }

        $this->transaction_id = $transaction->id;
        $this->charge_id = $transaction->charge_id;
        $this->payment_method_id = $transaction->payment_method_id;
        $this->amount = $transaction->amount;
        $this->paid_at = $transaction->paid_at ? $transaction->paid_at->format('Y-m-d\TH:i') : null;
        $this->comments = $transaction->comments;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $transaction = Transaction::find($this->transaction_id);

            if (!$transaction) {
                $this->dispatch('error', 'Transaction not found.');
                return;
            }

            $transaction->update([
                'charge_id' => $this->charge_id,
                'payment_method_id' => $this->payment_method_id,
                'amount' => $this->amount,
                'paid_at' => $this->paid_at,
                'comments' => $this->comments,
            ]);
        });

        $this->dispatch('success', 'Transaction updated successfully.');
        $this->emit('refreshTransactions');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
