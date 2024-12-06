<?php

namespace App\Http\Controllers\API;

use App\Http\Services\RoleService;
use App\Http\Traits\ApiTraits;
use Psr\Http\Message\RequestInterface;

class Roles extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly RoleService $service,
    ) {
        parent::__construct();
    }

    public function index(mixed $id)
    {
        return $this->service->_index($id);
    }
}
