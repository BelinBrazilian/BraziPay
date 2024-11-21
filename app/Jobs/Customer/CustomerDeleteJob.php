<?php

namespace App\Jobs\Customer;

use App\Models\Customer;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Customer as VindiCustomer;

class CustomerDeleteJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly int $external_id) {}

    public function handle(): void
    {
        try {
            $vindiCustomerService = new VindiCustomer(config('app.vindi_args'));
            $vindiCustomerService->delete($this->external_id);

            Log::debug('Customer deleted succesfully!');
        } catch (Exception $e) {
            Log::error('Error on deleting Vindi Customer: ' . $e->getMessage());
        }
    }
}
