<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Subscription as APISubscription;
use App\Http\Interfaces\UpdateRequestInterface;
use App\Http\Requests\SubscriptionStoreRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class Subscription extends Controller 
{
    public function __construct(private readonly APISubscription $api) {}

    public function index(mixed $queryParams = null): View
    {
        $data = $this->api->index($queryParams);

        return View('subscription.index', compact('data'));
    }

    public function show(mixed $code): View
    {
        $data = $this->api->show($code);

        return View('subscription.show', compact('data'));
    }

    public function store(SubscriptionStoreRequest $request): View
    {
        if ($data = $this->api->store($request)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        /** @todo consenso sobre exibição de erros */
    }

    public function update(UpdateRequestInterface $request, mixed $code): View 
    {
        $data = $this->api->update($request, $code);

        return View('subscription.show', compact('data'));
    }

    public function destroy(mixed $code): View 
    {
        $this->api->destroy($code);

        return $this->index();
    }

    public function reactivate(mixed $code): JsonResponse
    {
        return $this->api->reactivate($code);
    }

    public function renew(mixed $code): JsonResponse
    {
        return $this->api->renew($code);
    }

    public function product_items(mixed $code): View
    {
        $data = $this->api->product_items($code);

        return View('subscription.product_items', compact($data));
    }
}