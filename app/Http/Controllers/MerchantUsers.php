<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\MerchantUsers as APIMerchantUsers;
use App\Http\Traits\DestroyTrait;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\StoreTrait;
use App\Http\Traits\UpdateTrait;
use Illuminate\Contracts\View\View;

final class MerchantUsers extends Controller
{
    use IndexTrait, ShowTrait, StoreTrait, UpdateTrait, DestroyTrait;

    public function __construct(private readonly APIMerchantUsers $api) {}

    public function reactivate(int $id): View
    {
        $data = $this->api->reactivate($id);

        return View('merchant_users.show', compact('data'));
    }
}
