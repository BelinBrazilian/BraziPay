<?php

namespace App\Http\Controllers\API;

use App\Http\Services\MerchantUserService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Psr\Http\Message\RequestInterface;

class MerchantUsers extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly MerchantUserService $service,
    ) {
        parent::__construct();
    }

    public function reactivate(int $id): JsonResponse
    {
        return $this->service->_reactivate($id);
    }
}
