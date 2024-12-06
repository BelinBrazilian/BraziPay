<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Plans as APIPlans;
use App\Http\Requests\Plan\PlanStoreRequest;
use App\Http\Requests\Plan\PlanUpdateRequest;
use App\Models\Customer;
use Illuminate\View\View;

final class Plans extends Controller
{
    public function __construct(private readonly APIPlans $api) {}

    public function index(mixed $queryParams = null): View
    {
        $data = $this->api->index($queryParams);

        return View('customets.index', compact('data'));
    }

    public function show(string $code): View
    {
        $data = $this->api->show($code);

        return View('customets.index', compact('data'));
    }

    public function store(PlanStoreRequest $request): View
    {
        if ($data = $this->api->store($request)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function update(PlanUpdateRequest $request, string $code): View
    {
        if ($data = $this->api->update($request, $code)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function planItems(string $code): View
    {
        if ($this->api->plan_items($code)) {
            return $this->show($code);
        }

        /** @todo consenso sobre exibição de erros */
    }
}
