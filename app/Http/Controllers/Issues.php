<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Issues as APIIssues;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\UpdateTrait;

final class Issues extends Controller
{
    use IndexTrait, ShowTrait, UpdateTrait;

    public function __construct(private readonly APIIssues $api) {}
}
