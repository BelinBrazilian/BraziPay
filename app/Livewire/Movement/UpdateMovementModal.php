<?php

namespace App\Livewire\Movement;

use Livewire\Component;
use App\Models\Movement;
use App\Models\Bill;
use Illuminate\Support\Facades\DB;

class UpdateMovementModal extends Component
{
    public $movement_id;
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

    protected $listeners = ['modal.show.update_movement' => 'loadMovement'];

    public function mount()
    {
        $this->bills = Bill::with('customer')->get();
        $this->resetFields();
    }

    public function render()
    {
        return view('livewire.movements.update-movement-modal');
    }

    public function resetFields()
    {
        $this->movement_id = null;
        $this->bill_id = null;
        $this->amount = null;
        $this->movement_type = null;
        $this->origin = null;
        $this->description = null;
    }

    public function loadMovement($movement_id)
    {
        $movement = Movement::find($movement_id);

        if (!$movement) {
            $this->dispatch('error', 'Movement not found.');
            return;
        }

        $this->movement_id = $movement->id;
        $this->bill_id = $movement->bill_id;
        $this->amount = $movement->amount;
        $this->movement_type = $movement->movement_type;
        $this->origin = $movement->origin;
        $this->description = $movement->description;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $movement = Movement::find($this->movement_id);

            if (!$movement) {
                $this->dispatch('error', 'Movement not found.');
                return;
            }

            $movement->update([
                'bill_id' => $this->bill_id,
                'amount' => $this->amount,
                'movement_type' => $this->movement_type,
                'origin' => $this->origin,
                'description' => $this->description,
            ]);
        });

        $this->dispatch('success', 'Movement updated successfully.');
        $this->emit('refreshMovements');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
