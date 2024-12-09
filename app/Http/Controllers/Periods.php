<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Periods as APIPeriods;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\UpdateTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class Periods extends Controller
{
    use IndexTrait, ShowTrait, UpdateTrait;

    public function __construct(private readonly APIPeriods $api) {}

    public function bill(mixed $id): JsonResponse
    {
        return $this->api->bill($id);
    }

    public function usages(mixed $id): View
    {
        $data = $this->api->usages($id);

        return View('periods.usages', compact('data'));
    }
}
