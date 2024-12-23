<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateProductModal extends Component
{
    public $product_id;

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
        'code' => 'nullable|string|max:255|unique:products,code,{id}',
        'unit' => 'nullable|string|max:50',
        'status' => 'required|in:active,inactive,deleted',
        'description' => 'nullable|string',
        'invoice' => 'required|in:always,on_demand',
        'metadata' => 'nullable|json',
        'pricingSchema.price' => 'nullable|numeric|min:0',
        'pricingSchema.minimum_price' => 'nullable|numeric|min:0',
        'pricingSchema.schema_type' => 'nullable|string|max:50',
    ];

    protected $listeners = ['modal.show.product' => 'loadProduct'];

    public function render()
    {
        return view('livewire.products.update-product-modal');
    }

    public function resetFields()
    {
        $this->product_id = null;
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

    public function loadProduct($product_id)
    {
        $product = Product::with('pricingSchema')->find($product_id);

        if (! $product) {
            $this->dispatch('error', 'Product not found.');

            return;
        }

        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->code = $product->code;
        $this->unit = $product->unit;
        $this->status = $product->status->value;
        $this->description = $product->description;
        $this->invoice = $product->invoice->value;
        $this->metadata = json_encode($product->metadata);
        $this->pricingSchema = [
            'price' => $product->pricingSchema?->price,
            'minimum_price' => $product->pricingSchema?->minimum_price,
            'schema_type' => $product->pricingSchema?->schema_type,
        ];
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $product = Product::find($this->product_id);

            if (! $product) {
                $this->dispatch('error', 'Product not found.');

                return;
            }

            $product->update([
                'name' => $this->name,
                'code' => $this->code,
                'unit' => $this->unit,
                'status' => $this->status,
                'description' => $this->description,
                'invoice' => $this->invoice,
                'metadata' => $this->metadata ? json_decode($this->metadata, true) : null,
            ]);

            $product->pricingSchema()->updateOrCreate(
                ['product_id' => $product->id],
                [
                    'price' => $this->pricingSchema['price'],
                    'minimum_price' => $this->pricingSchema['minimum_price'],
                    'schema_type' => $this->pricingSchema['schema_type'],
                ]
            );
        });

        $this->dispatch('success', 'Product updated successfully.');
        $this->emit('refreshProducts');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
