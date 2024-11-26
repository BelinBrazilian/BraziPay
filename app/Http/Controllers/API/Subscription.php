<?php

namespace App\Http\Controllers\API;

use App\Http\Services\SubscriptionService;
use App\Http\Traits\ApiTraits;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Psr\Http\Message\RequestInterface;

class Subscription extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly SubscriptionService $service,
    ) {
        parent::__construct();
    }

    public function reactivate(mixed $id) : JsonResponse
    {
        return $this->service->reactivate($id);
    }

    public function renew(mixed $id): JsonResponse
    {
        return $this->service->renew($id);
    }

    public function product_items(mixed $id): Collection
    {
        return $this->service->product_items($id);
    }
}
