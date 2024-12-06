<?php

namespace App\Http\Controllers\API;

use App\Http\Services\ImportBatchService;
use App\Http\Traits\ApiTraits;
use Psr\Http\Message\RequestInterface;

class ImportBatches extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly ImportBatchService $service,
    ) {
        parent::__construct();
    }
}
