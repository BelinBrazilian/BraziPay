<?php

namespace App\Jobs\Discount;

use App\Helpers\VindiApi;
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
            $vindiDiscountService = new VindiDiscount(VindiApi::config());
            $vindiDiscountService->delete($this->external_id);

            Log::debug('Discount deleted succesfully!');
        } catch (Exception $e) {
            Log::error('Error on deleting Vindi Discount: '.$e->getMessage());
        }
    }
}
