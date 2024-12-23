<?php

namespace App\Http\Controllers\API;

use App\Http\Services\PlanService;
use App\Http\Traits\ApiTraits;
use App\Models\Plan;
use Illuminate\Http\Request;

class Plans extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly PlanService $service,
        private readonly Plan $model,
    ) {
//        parent::__construct();
    }

    public function plan_items(mixed $id)
    {
        return $this->service->plan_items($id);
    }
}
