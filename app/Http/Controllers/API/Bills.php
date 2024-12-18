<?php

namespace App\Http\Controllers\API;

use App\Http\Services\BillService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Bills extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly BillService $service,
    ) {
//        parent::__construct();
    }

    public function invoice(int $id): JsonResponse
    {
        return $this->service->_invoice($id);
    }

    public function charge(int $id): JsonResponse
    {
        return $this->service->_charge($id);
    }

    public function approve(int $id): JsonResponse
    {
        return $this->service->_approve($id);
    }

    public function billItems(int $id): JsonResponse
    {
        return $this->service->_bill_items($id);
    }
}
