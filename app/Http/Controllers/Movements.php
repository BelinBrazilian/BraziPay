<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Movements as APIMovements;
use App\Http\Traits\DestroyTrait;
use App\Http\Traits\StoreTrait;

final class Movements extends Controller
{
    use DestroyTrait, StoreTrait;

    public function __construct(private readonly APIMovements $api) {}
}
