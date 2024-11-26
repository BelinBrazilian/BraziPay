<?php

namespace App\Http\Repositories;

use App\Models\Subscription;

class SubscriptionRepository extends Repository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->modelClass = Subscription::class;
        parent::__construct();
    }
}
