<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Usages as APIUsages;
use App\Http\Traits\DestroyTrait;
use App\Http\Traits\StoreTrait;

final class Usages extends Controller
{
    use StoreTrait, DestroyTrait;

    public function __construct(private readonly APIUsages $api) {}
}
