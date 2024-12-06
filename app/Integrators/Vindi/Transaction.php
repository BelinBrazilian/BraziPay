<?php

namespace App\Integrators\Vindi;

use Vindi\Transaction as VindiTransaction;

/**
 * Class Plan
 *
 * @package Vindi
 */
class Transaction extends VindiTransaction
{
    public function recoveries()
    {
        return $this->get(null, 'recoveries');
    }
}
