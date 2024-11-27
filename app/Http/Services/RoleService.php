<?php

namespace App\Http\Services;

use App\Integrators\Vindi\Roles;

class RoleService
{
    public function __construct() {}

    public function index(?string $queryParams): array
    {
        $vindiRoleService = new Roles(config('app.vindi_args'));

        return $vindiRoleService->all();
    }
}
