<?php

namespace App\Jobs\Subscription;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Subscription;

class SubscriptionReactivateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly int $externalId) {}

    public function handle(): void
    {
        try {
            $vindiSubscriptionService = new Subscription(config('app.vindi_args'));
            $vindiSubscriptionService->reactivate($this->externalId);

            Log::debug('Subscription reactivated succesfully!');
        } catch (Exception $e) {
            Log::error('Error on reactivating Vindi Subscription: ' . $e->getMessage());
        }
    }
}
