<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Discounts as APIDiscounts;
use App\Http\Requests\Discount\DiscountStoreRequest;
use Illuminate\View\View;

class Discounts extends Controller
{
    public function __construct(private readonly APIDiscounts $api) {}

    public function index(mixed $queryParams = null): View
    {
        $data = $this->api->index($queryParams);

        return View('discounts.index', compact('data'));
    }

    public function show(string $id): View
    {
        $data = $this->api->show($id);

        return View('discounts.index', compact('data'));
    }

    public function store(DiscountStoreRequest $request): View
    {
        if ($data = $this->api->store($request)) {
            /** @var Discount $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function destroy(?string $id): View
    {
        if ($this->api->destroy($id)) {
            return $this->index();
        }

        /** @todo consenso sobre exibição de erros */
    }
}
