<?php

namespace App\Integrators\Vindi;

use Vindi\Resource;

/**
 * Class Plan
 *
 * @package Vindi
 */
class ProductItems extends Resource
{
    /**
     * The endpoint that will hit the API.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return 'products';
    }

    /**
     * Make a GET request to plans/{id}/plan_items.
     *
     * @param int $id The resource's id.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Vindi\Exceptions\RateLimitException
     * @throws \Vindi\Exceptions\RequestException
     */
    public function plan_items($id)
    {
        return $this->get($id, 'products_items');
    }
}
