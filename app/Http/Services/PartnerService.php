<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use App\Integrators\Vindi\Partners as VindiPartners;
use Illuminate\Http\JsonResponse;

final class PartnerService
{
    private readonly VindiPartners $vindiService;

    public function __construct() {
        $this->vindiService = new VindiPartners(VindiApi::config());
    }

    // direct functions
    public function _index(array $queryParams = []): JsonResponse
    {
        return $this->vindiService->all($queryParams);
    }

    public function _store(StoreRequestInterface $request): JsonResponse
    {
        return $this->vindiService->create($request->all());
    }

    // stored info functions
    /** @todo stored information functions */
}
