<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\Http\JsonResponse;
use Vindi\Usage as VindiUsage;

final class UsagesService
{
    private readonly VindiUsage $vindiService;

    public function __construct()
    {
        $this->vindiService = new VindiUsage(VindiApi::config());
    }

    // direct functions
    public function _store(StoreRequestInterface $request): JsonResponse
    {
        return $this->vindiService->create($request->all());
    }

    public function _destroy($id): JsonResponse
    {
        return $this->vindiService->delete($id);
    }

    // stored info functions
    /** @todo stored information functions */
}
