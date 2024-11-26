<?php

namespace App\Jobs\Affiliate;

use App\Http\DTOs\AffiliateDTO;
use App\Integrators\Vindi\Affiliates;
use App\Models\Affiliate;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class AffiliateVerifyJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Affiliate $affiliate) {}

    public function handle(): void
    {
        try {
            $vindiAffiliateService = new Affiliates(config('app.vindi_args'));
            $vindiAffiliate = $vindiAffiliateService->verify($this->affiliate->external_id);

            $this->affiliate->update((AffiliateDTO::fromArray((array) $vindiAffiliate))->toArray());

            Log::debug('Affiliate updated succesfully!');
        } catch (Exception $e) {
            Log::error('Error on updating Vindi Affiliate: ' . $e->getMessage());
        }
    }
}
