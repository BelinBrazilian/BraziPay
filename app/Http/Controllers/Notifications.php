<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Notifications as APINotifications;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Traits\DestroyTrait;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\StoreTrait;
use App\Http\Traits\UpdateTrait;
use Illuminate\Http\JsonResponse;

final class Notifications extends Controller
{
    use DestroyTrait, IndexTrait, ShowTrait, StoreTrait, UpdateTrait;

    public function __construct(private readonly APINotifications $api) {}

    public function notificationItemIndex(int $id, array $queryParams = []): JsonResponse
    {
        return $this->api->notificationItemIndex($id, $queryParams);
    }

    public function notificationItemStore(int $id, StoreRequestInterface $request): JsonResponse
    {
        return $this->api->notificationItemStore($id, $request);
    }

    public function notificationItemDestroy(int $notificationId, $notificationItemId): JsonResponse
    {
        return $this->api->notificationItemDestroy($notificationId, $notificationItemId);
    }
}
