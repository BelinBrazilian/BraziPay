<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiTraits;
use App\Models\Address;
use Illuminate\Http\Request;

class Addresses extends Controller
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly Address $model,
    ) {
        parent::__construct();
    }
}
