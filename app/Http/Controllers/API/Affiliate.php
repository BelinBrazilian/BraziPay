<?php

namespace App\Http\Controllers\API;

use App\Http\Services\AffiliateService;
use App\Http\Traits\ApiIndexTrait;
use App\Http\Traits\ApiShowTrait;
use App\Http\Traits\ApiStoreTrait;
use App\Http\Traits\ApiUpdateTrait;
use App\Models\Affiliate;
use Psr\Http\Message\RequestInterface;

class Affiliates extends ApiController
{
    use ApiIndexTrait, ApiShowTrait, ApiStoreTrait, ApiUpdateTrait;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly AffiliateService $service,
        private readonly Affiliate $model,
    ) {}

    public function verify(mixed $id): void
    {
        $this->service->verify($id);
    }
}
