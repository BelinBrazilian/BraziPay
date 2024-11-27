<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Products as APIProducts;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/**
 * Controller for managing product resources.
 *
 * This controller integrates with the APIProducts service to handle
 * operations related to products, such as listing, displaying, creating,
 * and updating product data. It ensures a clear separation between API logic
 * and view rendering.
 */
class Products extends Controller
{
    /**
     * The APIProducts service instance.
     */
    private readonly APIProducts $api;

    /**
     * Constructor for the Products controller.
     *
     * @param  APIProducts  $api  The API service for managing products.
     */
    public function __construct(APIProducts $api)
    {
        $this->api = $api;
    }

    /**
     * Display a listing of the products.
     *
     * @param  mixed|null  $queryParams  Optional query parameters for filtering or sorting.
     * @return View The view displaying the list of products.
     */
    public function index(mixed $queryParams = null): View
    {
        $data = $this->api->index($queryParams);

        return View('products.index', compact('data'));
    }

    /**
     * Display the specified product details.
     *
     * @param  string  $code  The unique code of the product to display.
     * @return View The view displaying the product details.
     */
    public function show(string $code): View
    {
        $data = $this->api->show($code);

        return View('products.index', compact('data'));
    }

    /**
     * Store a newly created product.
     *
     * @param  ProductStoreRequest  $request  The validated request containing product data.
     * @return View The view displaying the created product details or a generic error page.
     */
    public function store(ProductStoreRequest $request): View
    {
        if ($data = $this->api->store($request)) {
            /** @var Product $data */
            return $this->show($data->code);
        }

        // Log the error and return a generic error view
        Log::error('Failed to create the product. API store method returned null.');

        return View('errors.generic', [
            'message' => 'An error occurred while creating the product. Please try again later.',
        ]);
    }

    /**
     * Update the specified product.
     *
     * @param  ProductUpdateRequest  $request  The validated request containing updated product data.
     * @param  string  $code  The unique code of the product to update.
     * @return View The view displaying the updated product details or a generic error page.
     */
    public function update(ProductUpdateRequest $request, string $code): View
    {
        if ($data = $this->api->update($request, $code)) {
            /** @var Product $data */
            return $this->show($data->code);
        }

        // Log the error and return a generic error view
        Log::error('Failed to update the product. API update method returned null.');

        return View('errors.generic', [
            'message' => 'An error occurred while updating the product. Please try again later.',
        ]);
    }
}
