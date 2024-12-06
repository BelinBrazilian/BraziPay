<?php

namespace App\Http\Controllers\API;

use App\Http\Services\PaymentMethodService;
use App\Http\Traits\ApiTraits;
use Psr\Http\Message\RequestInterface;

class PaymentMethods extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly PaymentMethodService $service,
    ) {
        parent::__construct();
    }
}
