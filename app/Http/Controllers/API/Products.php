<?php

namespace App\Http\Controllers\API;

use App\Http\Services\ProductService;
use App\Http\Traits\ApiIndexTrait;
use App\Http\Traits\ApiShowTrait;
use App\Http\Traits\ApiStoreTrait;
use App\Http\Traits\ApiTraits;
use App\Http\Traits\ApiUpdateTrait;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * API Controller for handling product-related requests.
 *
 * This controller manages API requests for product resources,
 * leveraging the `ProductService` to handle business logic and the
 * `ApiTraits` for common API response functionalities. It acts as
 * an intermediary between the API routes and the service layer.
 *
 * @package App\Http\Controllers\API
 */
class Products extends ApiController
{
    use ApiTraits, ApiIndexTrait, ApiShowTrait, ApiStoreTrait, ApiUpdateTrait;

    /**
     * Products API controller constructor.
     *
     * This constructor injects dependencies, including the request
     * instance, product service, and product model, for handling
     * product-related API requests. The `parent::__construct()` call
     * initializes the base API controller.
     *
     * @param Request $request The HTTP request instance.
     * @param ProductService $service The service layer for product business logic.
     * @param Product $model The product model instance.
     */
    public function __construct(
        private readonly Request $request,
        private readonly ProductService $service,
        private readonly Product $model,
    ) {
        parent::__construct();
    }
}
