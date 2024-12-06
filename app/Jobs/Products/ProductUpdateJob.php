<?php

namespace App\Jobs\Products;

use App\Models\Product;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Product as VindiProduct;

class ProductUpdateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Product $product) {}

    public function handle(): void
    {
        try {
            $vindiProductService = new VindiProduct(config('app.vindi_args'));
            $vindiProductService->update($this->product->external_id, $this->product->normalize());

            Log::debug('Product updated succesfully!');
        } catch (Exception $e) {
            Log::error('Error on updating Vindi Product: '.$e->getMessage());
        }
    }
}
