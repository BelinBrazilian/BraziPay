<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Affiliates as APIAffiliates;
use App\Http\Requests\Affiliates\AffiliateStoreRequest;
use App\Http\Requests\Affiliates\AffiliateUpdateRequest;
use Illuminate\Contracts\View\View;

final class Affiliates extends Controller
{
    public function __construct(private readonly APIAffiliates $api) {}

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

    public function store(AffiliateStoreRequest $request): View
    {
        if ($data = $this->api->store($request)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function update(AffiliateUpdateRequest $request, string $code): View
    {
        if ($data = $this->api->update($request, $code)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function verify(mixed $code): void
    {
        $this->api->verify($code);
    }
}
