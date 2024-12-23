<?php

namespace App\Http\Controllers\API;

use App\Http\Services\ExportBatchService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExportBatches extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly ExportBatchService $service,
    ) {
        //        parent::__construct();
    }

    public function approve(int $id): JsonResponse
    {
        return $this->service->_approve($id);
    }
}
