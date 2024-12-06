<?php

namespace App\Http\Controllers\API;

use App\Http\Services\UsagesService;
use App\Http\Traits\ApiTraits;
use Psr\Http\Message\RequestInterface;

class Usages extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly UsagesService $service,
    ) {
        parent::__construct();
    }
}
