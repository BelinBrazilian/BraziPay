<?php

namespace App\Integrators\Vindi;

use Vindi\Resource;

/**
 * Class Plan
 */
class Users extends Resource
{
    /**
     * The endpoint that will hit the API.
     */
    public function endpoint(): string
    {
        return 'users/current';
    }
}
