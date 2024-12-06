<?php

namespace App\Jobs\Subscription;

use App\Helpers\VindiApi;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Subscription;

class SubscriptionRenewJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly int $externalId) {}

    public function handle(): void
    {
        try {
            $vindiSubscriptionService = new Subscription(VindiApi::config());
            $vindiSubscriptionService->renew($this->externalId);

            Log::debug('Subscription reactivated succesfully!');
        } catch (Exception $e) {
            Log::error('Error on reactivating Vindi Subscription: ' . $e->getMessage());
        }
    }
}
