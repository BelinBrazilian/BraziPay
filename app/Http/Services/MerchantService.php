<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\UpdateRequestInterface;
use Illuminate\Http\JsonResponse;
use Vindi\Merchant as VindiMerchant;

final class MerchantService
{
    private readonly VindiMerchant $vindiService;

    public function __construct() {
        $this->vindiService = new VindiMerchant(VindiApi::config());
    }

    // direct functions
    public function _index(array $queryParams = []): JsonResponse
    {
        return $this->vindiService->all($queryParams);
    }

    public function _show(int $id): JsonResponse
    {
        return $this->vindiService->retrieve($id);
    }

    public function _update(UpdateRequestInterface $request, int $id): JsonResponse
    {
        return $this->vindiService->update($id, $request->all());
    }

    public function _current(): JsonResponse
    {
        return $this->vindiService->get(null, 'current');
    }

    // stored info functions
    /** @todo stored information functions */
}
