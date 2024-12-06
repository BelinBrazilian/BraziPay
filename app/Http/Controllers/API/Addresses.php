<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

/**
 * Class Addresses
 *
 * Handles API operations related to addresses.*
 */
class Addresses extends Controller
{
    /**
     * Constructor.
     *
     * @param  Request  $request  The HTTP request instance.
     * @param  Address  $model  The Address model instance.
     */
    public function __construct(
        private readonly Request $request,
        private readonly Address $model,
    ) {}
}
