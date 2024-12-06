<?php

namespace App\Jobs\Customer;

use App\Helpers\VindiApi;
use App\Models\Customer;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Customer as VindiCustomer;

class CustomerUpdateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Customer $customer) {}

    public function handle(): void
    {
        try {
            $vindiCustomerService = new VindiCustomer(VindiApi::config());
            $vindiCustomerService->update($this->customer->external_id, $this->customer->normalize());

            Log::debug('Customer updated succesfully!');
        } catch (Exception $e) {
            Log::error('Error on updating Vindi Customer: '.$e->getMessage());
        }
    }
}
