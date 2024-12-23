<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;
use App\Integrators\Vindi\MerchantUsers as VindiMerchantUsers;
use Illuminate\Http\JsonResponse;

final class MerchantUserService
{
    private readonly VindiMerchantUsers $vindiService;

    public function __construct()
    {
        $this->vindiService = new VindiMerchantUsers(VindiApi::config());
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

    public function _destroy($id): JsonResponse
    {
        return $this->vindiService->delete($id);
    }

    public function _reactivate(int $id): JsonResponse
    {
        return $this->vindiService->reactivate($id);
    }

    // stored info functions
    /** @todo stored information functions */
}
