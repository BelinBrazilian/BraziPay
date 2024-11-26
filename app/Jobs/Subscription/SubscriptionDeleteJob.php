<?php

namespace App\Jobs\Subscription;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Subscription as VindiSubscription;

class SubscriptionDeleteJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly int $external_id) {}

    public function handle(): void
    {
        try {
            $vindiSubscriptionService = new VindiSubscription(config('app.vindi_args'));
            $vindiSubscriptionService->delete($this->external_id);

            Log::debug('Subscription deleted succesfully!');
        } catch (Exception $e) {
            Log::error('Error on deleting Vindi Subscription: ' . $e->getMessage());
        }
    }
}
