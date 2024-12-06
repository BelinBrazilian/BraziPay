<?php

namespace App\Integrators\Vindi;

use Vindi\Resource;

/**
 * Class Plan
 *
 * @package Vindi
 */
class NotificationItems extends Resource
{
    /**
     * The endpoint that will hit the API.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return 'notifications/%s/notification_items';
    }

    /**
     * Make a GET request to an additional endpoint for a specific resource.
     *
     * @param int    $id                 The resource's id.
     * @param string $additionalEndpoint Additional endpoint that will be appended to the URL.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Vindi\Exceptions\RateLimitException
     * @throws \Vindi\Exceptions\RequestException
     */
    public function index($notificationId, array $params = [])
    {
        return $this->apiRequester->request('GET', sprintf(
            $this->endpoint(), 
            $notificationId,
        ), $params);
    }

    /**
     * Create a new resource.
     *
     * @param array $form_params The request body.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Vindi\Exceptions\RateLimitException
     * @throws \Vindi\Exceptions\RequestException
     */
    public function store($notificationId, array $form_params = [])
    {
        return $this->apiRequester->request('POST', sprintf(
            $this->endpoint(), 
            $notificationId,
        ), ['json' => $form_params]);
    }

    /**
     * Delete a specific resource.
     *
     * @param int   $notificationId     The notification's id.
     * @param array $notificationItemId The notification item id to be deleted.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Vindi\Exceptions\RateLimitException
     * @throws \Vindi\Exceptions\RequestException
     */
    public function destroy($notificationId, $notificationItemId)
    {
        return $this->apiRequester->request('DELETE', sprintf(
            $this->endpoint() . '/%s', 
            $notificationId,
            $notificationItemId,
        ), []);
    }
}
