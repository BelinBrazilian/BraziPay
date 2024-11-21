<?php

namespace App\Http\Repositories;

use App\Models\Discount;

class DiscountRepository extends Repository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->modelClass = Discount::class;
        parent::__construct();
    }
}
