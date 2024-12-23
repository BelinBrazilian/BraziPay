<?php

namespace App\Http\Repositories;

use App\Models\Period;

class PeriodRepository extends Repository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->modelClass = Period::class;
        parent::__construct();
    }
}
