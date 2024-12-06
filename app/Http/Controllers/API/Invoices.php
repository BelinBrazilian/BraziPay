<?php

namespace App\Http\Controllers\API;

use App\Http\Services\InvoiceService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Psr\Http\Message\RequestInterface;

class Invoices extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly InvoiceService $service,
    ) {
        parent::__construct();
    }

    public function retry(int $id): JsonResponse
    {
        return $this->service->_retry($id); 
    }
}
