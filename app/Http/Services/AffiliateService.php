<?php

namespace App\Http\Services;

use App\Http\DTOs\AffiliateDTO;
use App\Http\Repositories\AffiliateRepository;
use App\Http\Requests\Affiliates\AffiliateStoreRequest;
use App\Http\Requests\Affiliates\AffiliateUpdateRequest;
use App\Integrators\Vindi\Affiliates;
use App\Jobs\Affiliate\AffiliateStoreJob;
use App\Jobs\Affiliate\AffiliateUpdateJob;
use App\Jobs\Affiliate\AffiliateVerifyJob;
use App\Models\Affiliate;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AffiliateService
{
    public function __construct(private readonly AffiliateRepository $repository) {}

    public function store(AffiliateStoreRequest $request) : Affiliate
    {
        try {
            DB::beginTransaction();

            $new = Affiliate::create((AffiliateDTO::fromRequest($request))->toArray());

            DB::commit();

            (new AffiliateStoreJob($new))->handle();

            return $new;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(AffiliateUpdateRequest $request, mixed $id) : Affiliate
    {
        try {
            DB::beginTransaction();

            $affiliate = $this->repository->find($id);
            $affiliate->update((AffiliateDTO::fromRequest($request))->toArray());

            DB::commit();

            (new AffiliateUpdateJob($affiliate))->handle();

            return $affiliate;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function verify(mixed $id) : void
    {
        $affiliate = $this->repository->find($id);
        (new AffiliateVerifyJob($affiliate))->handle();
    }

    public function _verify(mixed $id) : JsonResponse
    {
        $affiliate = $this->repository->find($id);
        $vindiAffiliateService = new Affiliates(config('app.vindi_args'));
        
        return $vindiAffiliateService->verify($affiliate->external_id);
    }
}
