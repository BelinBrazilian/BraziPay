<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\UpdateRequestInterface;
use App\Http\Repositories\PeriodRepository;
use Illuminate\Http\JsonResponse;
use Vindi\Period as VindiPeriod;

final class PeriodService
{
    private readonly VindiPeriod $vindiService;

    public function __construct(private readonly PeriodRepository $repository)
    {
        $this->vindiService = new VindiPeriod(VindiApi::config());
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

    public function _bill(int $id): JsonResponse
    {
        return $this->vindiService->bill($id);
    }

    public function _usages(int $id): JsonResponse
    {
        return $this->vindiService->usages($id);
    }

    // stored info functions
    /** @todo stored information functions */
}
