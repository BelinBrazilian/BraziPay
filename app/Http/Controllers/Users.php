<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Users as APIUsers;
use App\Http\Traits\IndexTrait;

final class Users extends Controller
{
    use IndexTrait;

    public function __construct(private readonly APIUsers $api) {}
}
