<?php

namespace App\Http\Controllers\API;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Services\NotificationService;
use App\Http\Traits\ApiTraits;
use Illuminate\Http\JsonResponse;
use Psr\Http\Message\RequestInterface;

class Notifications extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly RequestInterface $request,
        private readonly NotificationService $service,
    ) {
        parent::__construct();
    }

    public function notificationItemIndex(int $id, array $queryParams = []): JsonResponse
    {
        return $this->service->_notification_item_index($id, $queryParams);
    }

    public function notificationItemStore(int $id, StoreRequestInterface $request): JsonResponse
    {
        return $this->service->_notification_item_store($id, $request);
    }

    public function notificationItemDestroy(int $notificationId, $notificationItemId): JsonResponse
    {
        return $this->service->_notification_item_destroy($notificationId, $notificationItemId); 
    }
}
