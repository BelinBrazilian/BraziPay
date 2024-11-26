<?php

namespace App\Http\Services;

use App\Http\DTOs\ProductDTO;
use App\Http\DTOs\ProductItemDTO;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductItem;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Service layer for managing product-related business logic.
 *
 * This service class handles the business logic for product-related
 * operations, acting as an intermediary between the controller and
 * the repository. It encapsulates complex operations and makes the
 * controller code cleaner and easier to maintain.
 *
 * @package App\Http\Services
 */
readonly class ProductService
{
    /**
     * ProductService constructor.
     *
     * @param ProductRepository $repository The repository instance used to access product data.
     */
    public function __construct(private ProductRepository $repository) {}

    public function product_items(mixed $id) : array
    {
        return $this->repository->find($id)->productItems()->toArray();
    }

    public function _product_items(mixed $id) : array
    {
        $product = $this->repository->find($id);

        $vindiProductItemService = new ProductItem(config('app.vindi_args'));
        return $vindiProductItemService->product_items($product->external_id);
    }

    public function store(ProductStoreRequest $request) : Product
    {
        try {
            DB::beginTransaction();

            $new = Product::create((ProductDTO::fromRequest($request)));
            foreach($request->getProductItemFields() as $productItem) {
                $productItem['product_id'] = $new->id;
                ProductItem::create((ProductItemDTO::fromArray($productItem))->toArray());
            }

            DB::commit();

            (new ProductStoreJob($new))->handle();

            return $new;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(ProductUpdateRequest $request, mixed $id) : Product
    {
        try {
            DB::beginTransaction();

            $product = $this->repository->find($id);
            if (! empty($request->getProductItemFields())) {
                foreach ($product->productItems() as $productItem) {
                    $productItem->delete();
                }

                foreach ($request->getPlanItemFields() as $planItem) {
                    $productItem['product_id'] = $product->id;
                    ProductItem::create((ProductItemDTO::fromArray($productItem))->toArray());
                }
            }

            DB::commit();

            (new ProductUpdateJob($product))->handle();

            return $product;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
