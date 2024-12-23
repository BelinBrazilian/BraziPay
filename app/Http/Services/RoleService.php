<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Integrators\Vindi\Roles as VindiRoles;
use Illuminate\Http\JsonResponse;

final class RoleService
{
    private readonly VindiRoles $vindiService;

    public function __construct()
    {
        $this->vindiService = new VindiRoles(VindiApi::config());
    }

    // direct functions
    public function _index(?string $queryParams): JsonResponse
    {
        return $this->vindiService->all();
    }

    // stored info functions
    /** @todo stored information functions */
}
