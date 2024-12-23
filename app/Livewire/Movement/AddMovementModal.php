<?php

namespace App\Livewire\Movement;

use App\Models\Bill;
use App\Models\Movement;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddMovementModal extends Component
{
    public $bill_id;

    public $amount;

    public $movement_type;

    public $origin;

    public $description;

    public $bills;

    protected $rules = [
        'bill_id' => 'required|exists:bills,id',
        'amount' => 'required|numeric|min:0',
        'movement_type' => 'required|in:credit,debit',
        'origin' => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ];

    public function mount()
    {
        $this->bills = Bill::with('customer')->get();
        $this->resetFields();
    }

    public function render()
    {
        return view('livewire.movements.add-movement-modal');
    }

    public function resetFields()
    {
        $this->bill_id = null;
        $this->amount = null;
        $this->movement_type = null;
        $this->origin = null;
        $this->description = null;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            Movement::create([
                'bill_id' => $this->bill_id,
                'amount' => $this->amount,
                'movement_type' => $this->movement_type,
                'origin' => $this->origin,
                'description' => $this->description,
            ]);
        });

        $this->dispatch('success', 'Movement added successfully.');
        $this->resetFields();
        $this->emit('refreshMovements');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
