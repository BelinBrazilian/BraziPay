<?php

namespace App\Http\Controllers\API;

use App\Http\Services\CustomerService;
use App\Http\Traits\ApiTraits;
use App\Models\Customer;
use Illuminate\Http\Request;

class Customers extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly CustomerService $service,
        private readonly Customer $model,
    ) {
        parent::__construct();
    }

    public function unarchive(mixed $id): Customer
    {
        return $this->service->unarchive($id);
    }
}
