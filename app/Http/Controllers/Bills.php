<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Bills as APIBills;
use App\Http\Traits\DestroyTrait;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\StoreTrait;
use App\Http\Traits\UpdateTrait;
use Illuminate\Http\JsonResponse;

final class Bills extends Controller
{
    use DestroyTrait, IndexTrait, ShowTrait, StoreTrait, UpdateTrait;

    public function __construct(private readonly APIBills $api) {}

    public function invoice(int $id): JsonResponse
    {
        return $this->api->invoice($id);
    }

    public function charge(int $id): JsonResponse
    {
        return $this->api->charge($id);
    }

    public function approve(int $id): JsonResponse
    {
        return $this->api->approve($id);
    }

    public function billItems(int $id): JsonResponse
    {
        return $this->api->billItems($id);
    }
}
