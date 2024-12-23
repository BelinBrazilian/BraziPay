<?php

namespace App\Http\Controllers\API;

use App\Http\Services\ImportBatchService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class ImportBatches extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly ImportBatchService $service,
    ) {
        //        parent::__construct();
    }
}
