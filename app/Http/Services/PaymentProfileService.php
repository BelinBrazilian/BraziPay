<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;
use Illuminate\Http\JsonResponse;
use Vindi\PaymentProfile as VindiPaymentProfile;

final class PaymentProfileService
{
    private readonly VindiPaymentProfile $vindiService;

    public function __construct()
    {
        $this->vindiService = new VindiPaymentProfile(VindiApi::config());
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

    public function _verify(int $id): JsonResponse
    {
        return $this->vindiService->verify($id);
    }

    // stored info functions
    /** @todo stored information functions */
}
