<?php

namespace App\Http\Controllers\API;

use App\Http\Services\ChargeService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Charges extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly ChargeService $service,
    ) {
//        parent::__construct();
    }

    public function capture(int $id): JsonResponse
    {
        return $this->service->_capture($id);
    }

    public function fraud_review(int $id): JsonResponse
    {
        return $this->service->_fraud_review($id);
    }

    public function refund(int $id, ?array $queryParams = []): JsonResponse
    {
        return $this->service->_refund($id, $queryParams);
    }

    public function charge(int $id, ?array $queryParams = []): JsonResponse
    {
        return $this->service->_charge($id, $queryParams);
    }

    public function reissue(int $id, ?array $queryParams = []): JsonResponse
    {
        return $this->service->_reissue($id, $queryParams);
    }
}
