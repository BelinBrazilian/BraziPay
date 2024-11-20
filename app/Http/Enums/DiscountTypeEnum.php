<?php

namespace App\Http\Enums;

enum DiscountTypeEnum: string
{
    case Percentage = 'percentage';
    case Amount = 'amount';
    case Quantity = 'quantity';
}
