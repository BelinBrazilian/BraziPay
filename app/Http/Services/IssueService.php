<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\UpdateRequestInterface;
use Illuminate\Http\JsonResponse;
use Vindi\Issue as VindiIssue;

final class IssueService
{
    private readonly VindiIssue $vindiService;

    public function __construct()
    {
        $this->vindiService = new VindiIssue(VindiApi::config());
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

    // stored info functions
    /** @todo stored information functions */
}
