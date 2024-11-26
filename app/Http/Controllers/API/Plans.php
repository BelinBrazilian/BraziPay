<?php

namespace App\Http\Controllers\API;

use App\Http\Services\PlanService;
use App\Http\Traits\ApiIndexTrait;
use App\Http\Traits\ApiShowTrait;
use App\Http\Traits\ApiStoreTrait;
use App\Http\Traits\ApiTraits;
use App\Http\Traits\ApiUpdateTrait;
use App\Models\Plan;
use Psr\Http\Message\RequestInterface;

class Plans extends ApiController
{
    use ApiIndexTrait, ApiShowTrait, ApiStoreTrait, ApiUpdateTrait;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly PlanService $service,
        private readonly Plan $model,
    ) {
        parent::__construct();
    }

    public function plan_items(mixed $id)
    {
        return $this->service->plan_items($id);
    }
}
