<?php

namespace App\Http\Controllers\API;

use App\Http\Services\MessageService;
use App\Http\Traits\ApiTraits;
use Psr\Http\Message\RequestInterface;

class Messages extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly MessageService $service,
    ) {
        parent::__construct();
    }
}
