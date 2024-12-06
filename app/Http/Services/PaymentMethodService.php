<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use Illuminate\Http\JsonResponse;
use Vindi\PaymentMethod as VindiPaymentMethod;

final class PaymentMethodService
{
    private readonly VindiPaymentMethod $vindiService;

    public function __construct() {
        $this->vindiService = new VindiPaymentMethod(VindiApi::config());
    }

    // direct functions
    public function _index(array $queryParams = []): JsonResponse
    {
        return $this->vindiService->all($queryParams);
    }

    public function _show(int $id): JsonResponse
    {
        return $this->vindiService->retrieve($id);
    }

    // stored info functions
    /** @todo stored information functions */
}
