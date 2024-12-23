<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Transactions as APITransactions;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\StoreTrait;
use App\Http\Traits\UpdateTrait;
use Illuminate\Contracts\View\View;

final class Transactions extends Controller
{
    use IndexTrait, ShowTrait, StoreTrait, UpdateTrait;

    public function __construct(private readonly APITransactions $api) {}

    public function recoveries(int $id): View
    {
        $data = $this->api->recoveries($id);

        return View('transactions.show', compact('data'));
    }
}
