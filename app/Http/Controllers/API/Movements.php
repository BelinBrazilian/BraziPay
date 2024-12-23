<?php

namespace App\Http\Controllers\API;

use App\Http\Services\MovementsService;
use App\Http\Traits\ApiTraits;
use Psr\Http\Message\RequestInterface;

class Movements extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly MovementsService $service,
    ) {
        parent::__construct();
    }
}
