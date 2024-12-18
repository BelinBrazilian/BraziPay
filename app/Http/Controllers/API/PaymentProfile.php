<?php

namespace App\Http\Controllers\API;

use App\Http\Services\PaymentProfileService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentProfile extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly PaymentProfileService $service,
    ) {
//        parent::__construct();
    }

    public function verify(int $id): JsonResponse
    {
        return $this->service->_verify($id);
    }
}
