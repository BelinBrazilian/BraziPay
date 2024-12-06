<?php

namespace App\Http\Controllers\API;

use App\Http\Services\DiscountService;
use App\Http\Traits\ApiTraits;
use App\Models\Discount;
use Psr\Http\Message\RequestInterface;

class Discounts extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly DiscountService $service,
        private readonly Discount $model,
    ) {
        parent::__construct();
    }
}
