<?php

namespace App\Integrators\Vindi;

use Vindi\Resource;

/**
 * Class Plan
 *
 * @package Vindi
 */
class Partners extends Resource
{
    /**
     * The endpoint that will hit the API.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return 'partner/accounts';
    }
}
