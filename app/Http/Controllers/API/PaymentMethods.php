<?php

namespace App\Http\Controllers\API;

use App\Http\Services\PaymentMethodService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class PaymentMethods extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly PaymentMethodService $service,
    ) {
        //        parent::__construct();
    }
}
