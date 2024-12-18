<?php

namespace App\Http\Controllers\API;

use App\Http\Services\TransactionService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Transactions extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly TransactionService $service,
    ) {
//        parent::__construct();
    }

    public function recoveries(int $id): JsonResponse
    {
        return $this->service->_recoveries($id);
    }
}
