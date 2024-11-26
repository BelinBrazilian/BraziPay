<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Products as APIProducts;
use App\Http\Requests\Product\ProductStoreRequest as ProductStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller for managing product-related actions.
 *
 * This controller handles requests related to product resources,
 * including retrieving, creating, updating, and deleting products.
 *
 * @package App\Http\Controllers
 */
class Products extends Controller
{
    public function __construct(private readonly APIProducts $api) {}

    public function index(mixed $queryParams = null): View
    {
        $data = $this->api->index($queryParams);

        return View('products.index', compact('data'));
    }

    public function show(string $code): View
    {
        $data = $this->api->show($code);

        return View('products.index', compact('data'));
    }

    public function store(ProductStoreRequest $request): View
    {
        if ($data = $this->api->store($request)) {
            /** @var Product $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function update(ProductUpdateRequest $request, string $code): View
    {
        if ($data = $this->api->update($request, $code)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }
}
