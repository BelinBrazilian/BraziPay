<?php

namespace App\Http\Controllers\API;

use App\Http\Services\PartnerService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class Partners extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly PartnerService $service,
    ) {
//        parent::__construct();
    }
}
