<?php

namespace App\Jobs\Affiliate;

use App\Integrators\Vindi\Affiliates;
use App\Models\Affiliate;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class AffiliateStoreJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Affiliate $affiliate) {}

    public function handle(): void
    {
        try {
            $vindiAffiliateService = new Affiliates(config('app.vindi_args'));
            $vindiAffiliate = $vindiAffiliateService->create($this->affiliate->normalize());

            $this->affiliate->update(['external_id' => $vindiAffiliate->id]);

            Log::debug('Affiliate created succesfully!');
        } catch (Exception $e) {
            Log::error('Error on creating Vindi Affiliate: '.$e->getMessage());
        }
    }
}
