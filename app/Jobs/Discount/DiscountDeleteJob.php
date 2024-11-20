<?php

namespace App\Jobs\Discount;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Discount as VindiDiscount;

class DiscountDeleteJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly int $external_id) {}

    public function handle(): void
    {
        try {
            $vindiDiscountService = new VindiDiscount(config('app.vindi_args'));
            $vindiDiscountService->delete($this->external_id);

            Log::debug('Discount created succesfully!');
        } catch (Exception $e) {
            Log::error('Error on creating Vindi Discount: ' . $e->getMessage());
        }
    }
}
