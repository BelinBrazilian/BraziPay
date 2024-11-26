<?php

namespace App\Jobs\Products;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Product as VindiProduct;

class ProductStoreJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Product $product) {}

    public function handle(): void
    {
        try {
            $vindiProductService = new VindiProduct(config('app.vindi_args'));
            $vindiProduct = $vindiProductService->create($this->product->normalize());

            $this->product->update(['external_id' => $vindiProduct->id]);

            Log::debug('Product created succesfully!');
        } catch (Exception $e) {
            Log::error('Error on creating Vindi Product: ' . $e->getMessage());
        }
    }
}
