<?php

namespace App\Livewire\Discount;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use App\Models\Discount;
use App\Models\ProductItem;
use Illuminate\Support\Facades\DB;

class UpdateDiscountModal extends Component
{
    public $discount_id;
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

    protected $listeners = ['modal.show.update_discount' => 'loadDiscount'];

    public function mount(): void
    {
        $this->product_items = ProductItem::all();
        $this->resetFields();
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.discount.update-discount-modal');
    }

    public function resetFields(): void
    {
        $this->discount_id = null;
        $this->product_item_id = null;
        $this->discount_type = null;
        $this->percentage = null;
        $this->amount = null;
        $this->quantity = null;
        $this->cycles = null;
    }

    public function loadDiscount($discount_id): void
    {
        $discount = Discount::find($discount_id);

        if (!$discount) {
            $this->dispatch('error', 'Discount not found.');
            return;
        }

        $this->discount_id = $discount->id;
        $this->product_item_id = $discount->product_item_id;
        $this->discount_type = $discount->discount_type;
        $this->percentage = $discount->percentage;
        $this->amount = $discount->amount;
        $this->quantity = $discount->quantity;
        $this->cycles = $discount->cycles;
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction(function () {
            $discount = Discount::find($this->discount_id);

            if (!$discount) {
                $this->dispatch('error', 'Discount not found.');
                return;
            }

            $discount->update([
                'product_item_id' => $this->product_item_id,
                'discount_type' => $this->discount_type,
                'percentage' => $this->percentage,
                'amount' => $this->amount,
                'quantity' => $this->quantity,
                'cycles' => $this->cycles,
            ]);
        });

        $this->dispatch('success', 'Discount updated successfully.');
        $this->emit('refreshDiscounts');
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
