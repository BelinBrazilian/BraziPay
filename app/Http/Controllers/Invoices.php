<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Invoices as APIInvoices;
use App\Http\Traits\DestroyTrait;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\StoreTrait;
use App\Http\Traits\UpdateTrait;
use Illuminate\Http\JsonResponse;

final class Invoices extends Controller
{
    use IndexTrait, ShowTrait, StoreTrait, UpdateTrait, DestroyTrait;

    public function __construct(private readonly APIInvoices $api) {}

    public function retry(int $id): JsonResponse
    {
        return $this->api->retry($id); 
    }
}
