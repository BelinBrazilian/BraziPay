<?php

namespace App\Integrators\Vindi;

use Vindi\Transaction as VindiTransaction;

/**
 * Class Plan
 */
class Transaction extends VindiTransaction
{
    public function recoveries()
    {
        return $this->get(null, 'recoveries');
    }
}
