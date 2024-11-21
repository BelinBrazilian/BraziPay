<?php

namespace App\Http\Repositories;

use App\Models\Affiliate;

class AffiliateRepository extends Repository
{
    public function __construct()
    {
        $this->modelClass = Affiliate::class;
        parent::__construct();
    }
}
