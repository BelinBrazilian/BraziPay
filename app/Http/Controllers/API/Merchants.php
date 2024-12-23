<?php

namespace App\Http\Controllers\API;

use App\Http\Services\MerchantService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Merchants extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly MerchantService $service,
    ) {
        //        parent::__construct();
    }

    public function current(): JsonResponse
    {
        return $this->service->_current();
    }
}
