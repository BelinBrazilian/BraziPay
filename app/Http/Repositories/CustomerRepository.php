<?php

namespace App\Http\Repositories;

use App\Models\Customer;

class CustomerRepository extends Repository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->modelClass = Customer::class;
        parent::__construct();
    }
}
