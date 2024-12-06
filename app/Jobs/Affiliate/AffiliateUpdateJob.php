<?php

namespace App\Jobs\Affiliate;

use App\Helpers\VindiApi;
use App\Integrators\Vindi\Affiliates;
use App\Models\Affiliate;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class AffiliateUpdateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Affiliate $affiliate) {}

    public function handle(): void
    {
        try {
            $vindiAffiliateService = new Affiliates(VindiApi::config());
            $vindiAffiliateService->update($this->affiliate->external_id, $this->affiliate->normalize(true));

            Log::debug('Affiliate updated succesfully!');
        } catch (Exception $e) {
            Log::error('Error on updating Vindi Affiliate: '.$e->getMessage());
        }
    }
}
