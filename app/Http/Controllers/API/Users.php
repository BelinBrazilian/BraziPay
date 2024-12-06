<?php

namespace App\Http\Controllers\API;

use App\Http\Services\UserService;
use App\Http\Traits\ApiTraits;
use Psr\Http\Message\RequestInterface;

class Users extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly UserService $service,
    ) {
        parent::__construct();
    }
}
