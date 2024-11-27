<?php

namespace App\Jobs\Subscription;

use App\Models\Subscription;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Subscription as VindiSubscription;

class SubscriptionUpdateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Subscription $subscription) {}

    public function handle(): void
    {
        try {
            $vindiSubscriptionService = new VindiSubscription(config('app.vindi_args'));
            $vindiSubscriptionService->update($this->subscription->external_id, $this->subscription->normalize());

            Log::debug('Subscription updated succesfully!');
        } catch (Exception $e) {
            Log::error('Error on updating Vindi Subscription: '.$e->getMessage());
        }
    }
}
