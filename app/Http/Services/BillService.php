<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;
use App\Http\Repositories\PeriodRepository;
use Illuminate\Http\JsonResponse;
use App\Integrators\Vindi\Bill as VindiBill;

final class BillService
{
    private readonly VindiBill $vindiService;

    public function __construct(private readonly PeriodRepository $repository)
    {
        $this->vindiService = new VindiBill(VindiApi::config());
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

    public function _destroy($id, ?array $queryParams = []): JsonResponse
    {
        return $this->vindiService->delete($id, $queryParams);
    }

    public function _invoice(int $id): JsonResponse
    {
        return $this->vindiService->invoice($id);
    }

    public function _charge(int $id): JsonResponse
    {
        return $this->vindiService->charge($id);
    }

    public function _approve(int $id): JsonResponse
    {
        return $this->vindiService->approve($id);
    }

    public function _bill_items(int $id): JsonResponse
    {
        return $this->vindiService->billItems($id);
    }

    // stored info functions
    /** @todo stored information functions */
}
