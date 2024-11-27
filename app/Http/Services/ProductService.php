<?php

namespace App\Http\Services;

use App\Http\DTOs\ProductDTO;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Jobs\Products\ProductStoreJob;
use App\Jobs\Products\ProductUpdateJob;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Service layer for managing product-related business logic.
 *
 * This service class handles the business logic for product-related
 * operations, acting as an intermediary between the controller and
 * the repository. It encapsulates complex operations and makes the
 * controller code cleaner and easier to maintain.
 */
readonly class ProductService
{
    /**
     * ProductService constructor.
     *
     * @param  ProductRepository  $repository  The repository instance used to access product data.
     */
    public function __construct(private ProductRepository $repository) {}

    public function store(ProductStoreRequest $request): Product|JsonResponse
    {
        try {
            $new = Product::create((ProductDTO::fromRequest($request)));
            (new ProductStoreJob($new))->handle();

            return $new;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(ProductUpdateRequest $request, mixed $id): Product|JsonResponse
    {
        try {
            $product = $this->repository->find($id);
            (new ProductUpdateJob($product))->handle();

            return $product;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
