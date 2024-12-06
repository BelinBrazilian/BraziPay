<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;
use Illuminate\Http\JsonResponse;
use Vindi\Invoice as VindiInvoice;

final class InvoiceService
{
    private readonly VindiInvoice $vindiService;

    public function __construct()
    {
        $this->vindiService = new VindiInvoice(VindiApi::config());
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

    public function _retry(int $id): JsonResponse
    {
        return $this->vindiService->retry($id); 
    }

    // stored info functions
    /** @todo stored information functions */
}
