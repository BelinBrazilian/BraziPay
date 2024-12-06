<?php

namespace App\Http\Controllers\API;

use App\Http\Services\PartnerService;
use App\Http\Traits\ApiTraits;
use Psr\Http\Message\RequestInterface;

class Partners extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly PartnerService $service,
    ) {
        parent::__construct();
    }
}
