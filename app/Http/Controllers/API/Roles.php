<?php

namespace App\Http\Controllers\API;

use App\Http\Services\RoleService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class Roles extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly RoleService $service,
    ) {
        parent::__construct();
    }

    public function index(mixed $id)
    {
        return $this->service->_index($id);
    }
}
