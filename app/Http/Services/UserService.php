<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Integrators\Vindi\Users as VindiUsers;
use Illuminate\Http\JsonResponse;

final class UserService
{
    private readonly VindiUsers $vindiService;

    public function __construct()
    {
        $this->vindiService = new VindiUsers(VindiApi::config());
    }

    // direct functions
    public function _index(): JsonResponse
    {
        return $this->vindiService->all();
    }

    // stored info functions
    /** @todo stored information functions */
}
