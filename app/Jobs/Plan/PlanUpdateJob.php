<?php

namespace App\Jobs\Customer;

use App\Helpers\VindiApi;
use App\Models\Plan;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Vindi\Plan as VindiPlan;

class PlanUpdateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Plan $plan) {}

    public function handle(): void
    {
        try {
            $vindiPlanService = new VindiPlan(VindiApi::config());
            $vindiPlanService->update($this->plan->external_id, $this->plan->normalize());

            Log::debug('Plan updated succesfully!');
        } catch (Exception $e) {
            Log::error('Error on updating Vindi Plan: ' . $e->getMessage());
        }
    }
}
