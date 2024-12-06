<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\UpdateRequestInterface;
use App\Http\Repositories\PeriodRepository;
use Illuminate\Http\JsonResponse;
use Vindi\Charge as VindiCharge;

final class ChargeService
{
    private readonly VindiCharge $vindiService;

    public function __construct(private readonly PeriodRepository $repository)
    {
        $this->vindiService = new VindiCharge(VindiApi::config());
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

    public function _destroy($id, ?array $queryParams = []): JsonResponse
    {
        return $this->vindiService->delete($id, $queryParams);
    }

    public function _capture(int $id): JsonResponse
    {
        return $this->vindiService->capture($id);
    }

    public function _fraud_review(int $id): JsonResponse
    {
        return $this->vindiService->fraudReview($id);
    }

    public function _refund(int $id, ?array $queryParams = []): JsonResponse
    {
        return $this->vindiService->refund($id, $queryParams);
    }

    public function _charge(int $id, ?array $queryParams = []): JsonResponse
    {
        return $this->vindiService->charge($id, $queryParams);
    }

    public function _reissue(int $id, ?array $queryParams = []): JsonResponse
    {
        return $this->vindiService->reissue($id, $queryParams);
    }

    // stored info functions
    /** @todo stored information functions */
}
