<?php

namespace App\Jobs\Customer;

use App\Models\Customer;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Customer as VindiCustomer;

class CustomerStoreJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Customer $customer) {}

    public function handle(): void
    {
        try {
            $vindiCustomerService = new VindiCustomer(config('app.vindi_args'));
            $vindiCustomer = $vindiCustomerService->create($this->customer->normalize());

            $this->customer->update(['external_id' => $vindiCustomer->id]);

            Log::debug('Customer created succesfully!');
        } catch (Exception $e) {
            Log::error('Error on creating Vindi Customer: '.$e->getMessage());
        }
    }
}
