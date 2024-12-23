<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\Http\JsonResponse;
use Vindi\Message as VindiMessage;

final class MessageService
{
    private readonly VindiMessage $vindiService;

    public function __construct()
    {
        $this->vindiService = new VindiMessage(VindiApi::config());
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

    // stored info functions
    /** @todo stored information functions */
}
