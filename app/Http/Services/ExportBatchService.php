<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\Http\JsonResponse;
use Vindi\ExportBatch as VindiExportBatch;

final class ExportBatchService
{
    private readonly VindiExportBatch $vindiService;

    public function __construct()
    {
        $this->vindiService = new VindiExportBatch(VindiApi::config());
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

    public function _approve(int $id): JsonResponse
    {
        return $this->vindiService->approve($id);
    }

    // stored info functions
    /** @todo stored information functions */
}
