<?php

namespace App\Http\Controllers\API;

use App\Http\Services\IssueService;
use App\Http\Traits\ApiTraits;
use Psr\Http\Message\RequestInterface;

class Issues extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly IssueService $service,
    ) {
        parent::__construct();
    }
}
