<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\PaymentProfile as APIPaymentProfile;
use App\Http\Traits\DestroyTrait;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\StoreTrait;
use App\Http\Traits\UpdateTrait;
use Illuminate\Http\JsonResponse;

final class PaymentProfile extends Controller
{
    use IndexTrait, ShowTrait, StoreTrait, UpdateTrait, DestroyTrait;

    public function __construct(private readonly APIPaymentProfile $api) {}

    public function verify(int $id): JsonResponse
    {
        return $this->api->verify($id);
    }
}
