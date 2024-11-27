<?php

namespace App\Integrators\Vindi;

use Vindi\Resource;

/**
 * Class Plan
 */
class Affiliates extends Resource
{
    /**
     * The endpoint that will hit the API.
     */
    public function endpoint(): string
    {
        return 'affiliates';
    }

    /**
     * Make a GET request to plans/{id}/plan_items.
     *
     * @param  int  $id  The resource's id.
     * @return mixed
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Vindi\Exceptions\RateLimitException
     * @throws \Vindi\Exceptions\RequestException
     */
    public function verify($id)
    {
        return $this->apiRequester->request('PUT', $this->url($id, 'verify'));
    }
}
