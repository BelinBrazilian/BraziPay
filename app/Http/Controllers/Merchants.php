<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Merchants as APIMerchants;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\UpdateTrait;
use Illuminate\Contracts\View\View;

final class Merchants extends Controller
{
    use IndexTrait, ShowTrait, UpdateTrait;

    public function __construct(private readonly APIMerchants $api) {}

    public function current(): View
    {
        $data = $this->api->current();

        return View('merchants.show', compact('data'));
    }
}
