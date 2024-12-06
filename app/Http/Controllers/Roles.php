<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Affiliates as APIAffiliates;
use Illuminate\Contracts\View\View;

final class Roles extends Controller
{
    public function __construct(private readonly APIAffiliates $api) {}

    public function index(mixed $queryParams = null): View
    {
        $data = $this->api->index($queryParams);

        return View('roles.index', compact('data'));
    }
}
