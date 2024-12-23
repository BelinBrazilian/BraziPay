<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;
use App\Integrators\Vindi\NotificationItems as VindiNotificationItem;
use Illuminate\Http\JsonResponse;
use Vindi\Notification as VindiNotification;

final class NotificationService
{
    private readonly VindiNotification $vindiNotificationService;

    private readonly VindiNotificationItem $vindiNotificationItemService;

    public function __construct()
    {
        $this->vindiNotificationService = new VindiNotification(VindiApi::config());
        $this->vindiNotificationItemService = new VindiNotificationItem(VindiApi::config());
    }

    // direct functions
    public function _index(array $queryParams = []): JsonResponse
    {
        return $this->vindiNotificationService->all($queryParams);
    }

    public function _show(int $id): JsonResponse
    {
        return $this->vindiNotificationService->retrieve($id);
    }

    public function _store(StoreRequestInterface $request): JsonResponse
    {
        return $this->vindiNotificationService->create($request->all());
    }

    public function _update(UpdateRequestInterface $request, int $id): JsonResponse
    {
        return $this->vindiNotificationService->update($id, $request->all());
    }

    public function _destroy($id): JsonResponse
    {
        return $this->vindiNotificationService->delete($id);
    }

    public function _notification_item_index(int $notificationId, array $queryParams = []): JsonResponse
    {
        return $this->vindiNotificationItemService->index($notificationId, $queryParams);
    }

    public function _notification_item_store(int $notificationId, StoreRequestInterface $request): JsonResponse
    {
        return $this->vindiNotificationItemService->store($notificationId, $request->all());
    }

    public function _notification_item_destroy(int $notificationId, int $notificationItemId): JsonResponse
    {
        return $this->vindiNotificationItemService->destroy($notificationId, $notificationItemId);
    }

    // stored info functions
    /** @todo stored information functions */
}
