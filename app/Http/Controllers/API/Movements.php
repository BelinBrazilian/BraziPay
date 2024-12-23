<?php

namespace App\Http\Controllers\API;

use App\Http\Services\MovementsService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class Movements extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly MovementsService $service,
    ) {
        //        parent::__construct();
    }
}
