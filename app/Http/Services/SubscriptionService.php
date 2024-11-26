<?php

namespace App\Http\Services;

use App\Http\DTOs\SubscriptionDTO;
use App\Http\Repositories\SubscriptionRepository;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;
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

class SubscriptionService
{
    public function __construct(private readonly SubscriptionRepository $repository) {}

    public function _index($page = 1, $per_page = 25, $query = '', $sort_by = 'id', $sort_order = 'desc') : JsonResponse
    {
        $vindiSubscriptionService = new VindiSubscription(config('app.vindi_args'));

        return $vindiSubscriptionService->all([
            'page' => $page,
            'per_page' => $per_page,
            'query' => $query,
            'sort_by' => $sort_by,
            'sort_order' => $sort_order,
        ]);
    }

    public function _show(mixed $id) : JsonResponse
    {
        $subscription = $this->repository->find($id);
        $vindiSubscriptionService = new VindiSubscription(config('app.vindi_args'));

        return $vindiSubscriptionService->get($subscription->external_id);
    }

    public function store(SubscriptionStoreRequest $request) : Subscription
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

    public function update(SubscriptionUpdateRequest $request, mixed $id) : JsonResponse
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

    public function destroy(mixed $id) : JsonResponse
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

    public function reactivate(mixed $id) : JsonResponse
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

    public function _reactivate(mixed $id) : JsonResponse
    {
        $subscription = $this->repository->find($id);
        $vindiSubscriptionService = new VindiSubscription(config('app.vindi_args'));

        return $vindiSubscriptionService->reactivate($subscription->external_id);
    }

    public function renew(mixed $id) : JsonResponse
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

    public function _renew(mixed $id) : JsonResponse
    {
        $subscription = $this->repository->find($id);
        $vindiSubscriptionService = new VindiSubscription(config('app.vindi_args'));

        return $vindiSubscriptionService->renew($subscription->externalId);
    }

    public function product_items(mixed $id): Collection
    {
        $subscription = $this->repository->find($id);
        return $subscription->productItems();
    }

    public function _product_items(mixed $id): Collection
    {
        $subscription = $this->repository->find($id);
        $vindiSubscriptionService = new VindiSubscription(config('app.vindi_args'));

        return $vindiSubscriptionService->product_items($subscription->externalId);
    }
}
