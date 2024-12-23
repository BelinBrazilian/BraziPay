<?php

namespace App\Http\Controllers\API;

use App\Http\Services\UsagesService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class Usages extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly UsagesService $service,
    ) {
        //        parent::__construct();
    }
}
