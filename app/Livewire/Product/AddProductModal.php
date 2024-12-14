<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\PricingSchema;
use Illuminate\Support\Facades\DB;

class AddProductModal extends Component
{
    public $name;
    public $code;
    public $unit;
    public $status;
    public $description;
    public $invoice;
    public $metadata;
    public $pricingSchema = [
        'price' => null,
        'minimum_price' => null,
        'schema_type' => null,
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'nullable|string|max:255|unique:products,code',
        'unit' => 'nullable|string|max:50',
        'status' => 'required|in:active,inactive,deleted',
        'description' => 'nullable|string',
        'invoice' => 'required|in:always,on_demand',
        'metadata' => 'nullable|json',
        'pricingSchema.price' => 'nullable|numeric|min:0',
        'pricingSchema.minimum_price' => 'nullable|numeric|min:0',
        'pricingSchema.schema_type' => 'nullable|string|max:50',
    ];

    public function render()
    {
        return view('livewire.product.add-product-modal');
    }

    public function resetFields()
    {
        $this->name = null;
        $this->code = null;
        $this->unit = null;
        $this->status = null;
        $this->description = null;
        $this->invoice = null;
        $this->metadata = null;
        $this->pricingSchema = [
            'price' => null,
            'minimum_price' => null,
            'schema_type' => null,
        ];
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $product = Product::create([
                'name' => $this->name,
                'code' => $this->code,
                'unit' => $this->unit,
                'status' => $this->status,
                'description' => $this->description,
                'invoice' => $this->invoice,
                'metadata' => $this->metadata ? json_decode($this->metadata, true) : null,
            ]);

            $product->pricingSchema()->create([
                'price' => $this->pricingSchema['price'],
                'minimum_price' => $this->pricingSchema['minimum_price'],
                'schema_type' => $this->pricingSchema['schema_type'],
            ]);
        });

        $this->dispatch('success', 'Product added successfully.');
        $this->resetFields();
        $this->emit('refreshProducts');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
