<?php

namespace App\Jobs\Discount;

use App\Helpers\VindiApi;
use App\Models\Discount;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Discount as VindiDiscount;

class DiscountStoreJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Discount $discount) {}

    public function handle(): void
    {
        try {
            $vindiDiscountService = new VindiDiscount(VindiApi::config());
            $vindiDiscount = $vindiDiscountService->create($this->discount->normalize());

            $this->discount->update(['external_id' => $vindiDiscount->id]);

            Log::debug('Discount created succesfully!');
        } catch (Exception $e) {
            Log::error('Error on creating Vindi Discount: '.$e->getMessage());
        }
    }
}
