<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Messages as APIMessages;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\StoreTrait;

final class Messages extends Controller
{
    use IndexTrait, ShowTrait, StoreTrait;

    public function __construct(private readonly APIMessages $api) {}
}
