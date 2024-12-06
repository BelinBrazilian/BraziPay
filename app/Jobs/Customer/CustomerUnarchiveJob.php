<?php

namespace App\Jobs\Customer;

use App\Helpers\VindiApi;
use App\Models\Customer;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Customer as VindiCustomer;

class CustomerUnarchiveJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Customer $customer) {}

    public function handle(): void
    {
        try {
            $vindiCustomerService = new VindiCustomer(VindiApi::config());
            $vindiCustomerService->unarchive($this->customer->external_id);

            Log::debug('Customer unarchived succesfully!');
        } catch (Exception $e) {
            Log::error('Error on unarchiving Vindi Customer: '.$e->getMessage());
        }
    }
}
