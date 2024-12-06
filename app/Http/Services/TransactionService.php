<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;
use Illuminate\Http\JsonResponse;
use App\Integrators\Vindi\Transaction as VindiTransaction;

final class TransactionService
{
    private readonly VindiTransaction $vindiService;

    public function __construct() {
        $this->vindiService = new VindiTransaction(VindiApi::config());
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

    public function _store(StoreRequestInterface $request): JsonResponse
    {
        return $this->vindiService->create($request->all());
    }

    public function _update(UpdateRequestInterface $request, int $id): JsonResponse
    {
        return $this->vindiService->update($id, $request->all());
    }

    public function _recoveries(int $id): JsonResponse
    {
        return $this->vindiService->recoveries($id);
    }

    // stored info functions
    /** @todo stored information functions */
}
