<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\DTOs\SubscriptionDTO;
use App\Http\Repositories\SubscriptionRepository;
use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use App\Http\Requests\Subscription\SubscriptionUpdateRequest;
use App\Jobs\Subscription\SubscriptionDeleteJob;
use App\Jobs\Subscription\SubscriptionReactivateJob;
use App\Jobs\Subscription\SubscriptionRenewJob;
use App\Jobs\Subscription\SubscriptionStoreJob;
use App\Jobs\Subscription\SubscriptionUpdateJob;
use App\Models\Subscription;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Vindi\Subscription as VindiSubscription;

final class SubscriptionService
{
    private readonly VindiSubscription $vindiService;

    public function __construct(private readonly SubscriptionRepository $repository)
    {
        $this->vindiService = new VindiSubscription(VindiApi::config());
    }

    // direct functions
    public function _index(array $queryParams = []): JsonResponse
    {
        return $this->vindiService->all($queryParams);
    }

    public function _show(int $id): JsonResponse
    {
        return $this->vindiService->retrieve($id);
    }

    public function _reactivate(int $id): JsonResponse
    {
        return $this->vindiService->reactivate($id);
    }

    public function _renew(int $id): JsonResponse
    {
        return $this->vindiService->renew($id);
    }

    public function _product_items(int $id): Collection
    {
        return $this->vindiService->product_items($id);
    }

    // stored info functions
    public function store(SubscriptionStoreRequest $request): Subscription
    {
        try {
            DB::beginTransaction();

            $subscription = Subscription::create((SubscriptionDTO::fromRequest($request))->toArray());

            DB::commit();

            (new SubscriptionStoreJob($subscription))->handle();

            return $subscription;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(SubscriptionUpdateRequest $request, mixed $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $subscription = $this->repository->find($id);
            $subscription->update((SubscriptionDTO::fromRequest($request))->toArray());

            DB::commit();

            (new SubscriptionUpdateJob($subscription))->handle();

            return response()->json([], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(mixed $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $subscription = $this->repository->find($id);
            $external_id = $subscription->external_id;

            $subscription->delete();

            DB::commit();

            (new SubscriptionDeleteJob($external_id))->handle();

            return response()->json([], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function reactivate(mixed $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $subscription = $this->repository->find($id);
            $subscription->restore();

            DB::commit();

            (new SubscriptionReactivateJob($subscription->external_id))->handle();

            return response()->json([], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function renew(mixed $id): JsonResponse
    {
        try {
            $subscription = $this->repository->find($id);

            (new SubscriptionRenewJob($subscription->external_id))->handle();

            return response()->json([], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function product_items(mixed $id): Collection
    {
        $subscription = $this->repository->find($id);

        return $subscription->productItems();
    }
}
