<?php

namespace App\Http\Controllers\API;

use App\Http\Services\AffiliateService;
use App\Http\Traits\ApiTraits;
use App\Models\Affiliate;
use Illuminate\Http\Request;

class Affiliates extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly AffiliateService $service,
        private readonly Affiliate $model,
    ) {}

    public function verify(mixed $id): void
    {
        $this->service->verify($id);
    }
}
