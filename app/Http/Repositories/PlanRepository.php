<?php

namespace App\Http\Repositories;

use App\Models\Plan;

class PlanRepository extends Repository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->modelClass = Plan::class;
        parent::__construct();
    }
}
