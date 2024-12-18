<?php

namespace App\Http\Controllers\API;

use App\Http\Services\IssueService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class Issues extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly IssueService $service,
    ) {
//        parent::__construct();
    }
}
