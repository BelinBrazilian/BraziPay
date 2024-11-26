<?php

namespace App\Http\Controllers\API;

use App\Http\Services\RoleService;
use Psr\Http\Message\RequestInterface;

class Roles extends ApiController
{
    public function __construct(
        private readonly RequestInterface $request,
        private readonly RoleService $service,
    ) {
        parent::__construct();
    }

    public function index(mixed $id)
    {
        return $this->service->index($id);
    }
}
