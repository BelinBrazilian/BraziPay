<?php

namespace App\Integrators\Vindi;

use Vindi\Resource;

/**
 * Class Plan
 *
 * @package Vindi
 */
class MerchantUsers extends Resource
{
    /**
     * The endpoint that will hit the API.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return 'merchant_users';
    }

    /**
     * Reactivate a specific resource.
     *
     * @param int   $id          The resource's id.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Vindi\Exceptions\RateLimitException
     * @throws \Vindi\Exceptions\RequestException
     */
    public function reactivate(int $id)
    {
        return $this->apiRequester->request('POST', $this->url($id, 'reactivate'), []);
    }
}
