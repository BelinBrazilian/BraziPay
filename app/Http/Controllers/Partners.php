<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Partners as APIPartners;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\StoreTrait;

final class Partners extends Controller
{
    use IndexTrait, StoreTrait;

    public function __construct(private readonly APIPartners $api) {}
}
