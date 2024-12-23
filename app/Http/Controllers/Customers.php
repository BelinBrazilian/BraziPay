<?php

namespace App\Http\Controllers;

use App\DataTables\CustomersDataTable;
use App\Http\Controllers\API\Customers as APICustomers;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

final class Customers extends Controller
{
    public function __construct(private readonly APICustomers $api) {}

    // public function index(mixed $queryParams = null): View | AnonymousResourceCollection 
    // {
    //     $data = $this->api->index([]);

    //     return $data;

    public function index(CustomersDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('pages/customers/index');
    }

    public function show(string $code): View
    {
        $data = $this->api->show($code);

        return View('customers.index', compact('data'));
    }

    public function store(CustomerStoreRequest $request): View
    {
        if ($data = $this->api->store($request)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function update(CustomerUpdateRequest $request, string $code): View
    {
        if ($data = $this->api->update($request, $code)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function destroy(?string $code)
    {
        if ($this->api->destroy($code)) {
            // return $this->index();
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function unarchive(string $code): View
    {
        if ($this->api->unarchive($code)) {
            return $this->show($code);
        }

        /** @todo consenso sobre exibição de erros */
    }
}
