<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\PaymentMethods as APIPaymentMethods;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;

final class PaymentMethods extends Controller
{
    use IndexTrait, ShowTrait;

    public function __construct(private readonly APIPaymentMethods $api) {}
}
