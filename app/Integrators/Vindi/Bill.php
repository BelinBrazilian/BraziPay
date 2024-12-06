<?php

namespace App\Integrators\Vindi;

use Vindi\Bill as VindiBill;

/**
 * Class Plan
 *
 * @package Vindi
 */
class Bill extends VindiBill
{
    public function billItems(int $id)
    {
        return $this->get($id, 'bill_items');
    }
}
