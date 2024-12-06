<?php

namespace App\Jobs\Subscription;

use App\Helpers\VindiApi;
use App\Http\DTOs\PeriodDTO;
use App\Models\Period;
use App\Models\Subscription;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Subscription as VindiSubscription;

class SubscriptionStoreJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Subscription $subscription) {}

    public function handle(): void
    {
        try {
            $vindiSubscriptionService = new VindiSubscription(VindiApi::config());
            $vindiSubscription = $vindiSubscriptionService->create($this->subscription->normalize());

            $this->subscription->update(['external_id' => $vindiSubscription->id]);

            Period::create([
                'external_id' => $vindiSubscription->current_period->id,
                'subscription_id' => $this->subscription->id,
                'billing_at' => $vindiSubscription->current_period->billing_at,
                'cycle' => $vindiSubscription->current_period->cycle,
                'start_at' => $vindiSubscription->current_period->start_at,
                'end_at' => $vindiSubscription->current_period->end_at,
                'duration' => $vindiSubscription->current_period->duration,
            ]);

            Log::debug('Subscription updated succesfully!');
        } catch (Exception $e) {
            Log::error('Error on updating Vindi Subscription: '.$e->getMessage());
        }
    }
}
