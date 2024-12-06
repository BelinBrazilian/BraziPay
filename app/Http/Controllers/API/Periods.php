<?php

namespace App\Http\Controllers\API;

use App\Http\Services\PeriodService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Psr\Http\Message\RequestInterface;

class Periods extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly PeriodService $service,
    ) {
        parent::__construct();
    }

    public function bill(mixed $id): JsonResponse
    {
        return $this->service->_bill($id);
    }

    public function usages(mixed $id): JsonResponse
    {
        return $this->service->_usages($id);
    }
}
