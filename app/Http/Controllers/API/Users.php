<?php

namespace App\Http\Controllers\API;

use App\Http\Services\UserService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class Users extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly UserService $service,
    ) {
        parent::__construct();
    }
}
