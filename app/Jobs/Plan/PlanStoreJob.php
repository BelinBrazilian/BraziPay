<?php

namespace App\Jobs\Customer;

use App\Helpers\VindiApi;
use App\Models\Plan;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Plan as VindiPlan;

class PlanStoreJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Plan $plan) {}

    public function handle(): void
    {
        try {
            $vindiPlanService = new VindiPlan(VindiApi::config());
            $vindiPlan = $vindiPlanService->create($this->plan->normalize());

            $this->plan->update(['external_id' => $vindiPlan->id]);

            Log::debug('Plan created succesfully!');
        } catch (Exception $e) {
            Log::error('Error on creating Vindi Plan: ' . $e->getMessage());
        }
    }
}
