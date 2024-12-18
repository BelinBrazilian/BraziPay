<?php

namespace App\Livewire\Discount;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use App\Models\Discount;
use App\Models\ProductItem;
use Illuminate\Support\Facades\DB;

class AddDiscountModal extends Component
{
    public $product_item_id;
    public $discount_type;
    public $percentage;
    public $amount;
    public $quantity;
    public $cycles;

    public $product_items;

    protected array $rules = [
        'product_item_id' => 'required|exists:product_items,id',
        'discount_type' => 'required|in:percentage,amount',
        'percentage' => 'nullable|numeric|min:0|max:100|required_if:discount_type,percentage',
        'amount' => 'nullable|numeric|min:0|required_if:discount_type,amount',
        'quantity' => 'nullable|integer|min:1',
        'cycles' => 'nullable|integer|min:1',
    ];

    public function mount(): void
    {
        $this->product_items = ProductItem::all();
        $this->resetFields();
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.discounts.add-discount-modal');
    }

    public function resetFields(): void
    {
        $this->product_item_id = null;
        $this->discount_type = null;
        $this->percentage = null;
        $this->amount = null;
        $this->quantity = null;
        $this->cycles = null;
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction(function () {
            Discount::create([
                'product_item_id' => $this->product_item_id,
                'discount_type' => $this->discount_type,
                'percentage' => $this->percentage,
                'amount' => $this->amount,
                'quantity' => $this->quantity,
                'cycles' => $this->cycles,
            ]);
        });

        $this->dispatch('success', 'Discount added successfully.');
        $this->resetFields();
        $this->emit('refreshDiscounts');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
