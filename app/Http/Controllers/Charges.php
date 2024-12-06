<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Charges as APICharges;
use App\Http\Traits\DestroyTrait;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\UpdateTrait;
use Illuminate\Http\JsonResponse;

final class Charges extends Controller
{
    use IndexTrait, ShowTrait, UpdateTrait, DestroyTrait;

    public function __construct(private readonly APICharges $api) {}

    public function capture(int $id): JsonResponse
    {
        return $this->api->capture($id);
    }

    public function fraudReview(int $id): JsonResponse
    {
        return $this->api->fraud_review($id);
    }

    public function refund(int $id, ?array $queryParams = []): JsonResponse
    {
        return $this->api->refund($id, $queryParams);
    }

    public function charge(int $id, ?array $queryParams = []): JsonResponse
    {
        return $this->api->charge($id, $queryParams);
    }

    public function reissue(int $id, ?array $queryParams = []): JsonResponse
    {
        return $this->api->reissue($id, $queryParams);
    }
}
