<?php

namespace App\Http\Controllers\API;

use App\Http\Services\MessageService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\Request;

class Messages extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly MessageService $service,
    ) {
//        parent::__construct();
    }
}
