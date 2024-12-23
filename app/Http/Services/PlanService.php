<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\DTOs\PlanDTO;
use App\Http\DTOs\PlanItemDTO;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;
use App\Http\Repositories\PlanRepository;
use App\Http\Requests\Plan\PlanStoreRequest;
use App\Http\Requests\Plan\PlanUpdateRequest;
use App\Integrators\Vindi\PlanItems as VindiPlanItems;
use App\Jobs\Plan\PlanStoreJob;
use App\Jobs\Plan\PlanUpdateJob;
use App\Models\Plan;
use App\Models\PlanItem;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Vindi\Plan as VindiPlan;

final class PlanService
{
    private readonly VindiPlan $vindiPlanService;

    private readonly VindiPlanItems $vindiPlanItemsService;

    public function __construct(private readonly PlanRepository $repository)
    {
        $this->vindiPlanService = new VindiPlan(VindiApi::config());
        $this->vindiPlanItemsService = new VindiPlanItems(VindiApi::config());
    }

    // direct functions
    public function _store(StoreRequestInterface $request): JsonResponse
    {
        return $this->vindiPlanService->create($request->all());
    }

    public function _update(UpdateRequestInterface $request, int $id): JsonResponse
    {
        return $this->vindiPlanService->update($id, $request->all());
    }

    public function _plan_items(int $id): JsonResponse
    {
        return $this->vindiPlanItemsService->plan_items($id);
    }

    // stored info functions
    public function store(PlanStoreRequest $request): Plan
    {
        try {
            DB::beginTransaction();

            $new = Plan::create((PlanDTO::fromRequest($request)));
            foreach ($request->getPlanItemFields() as $planItem) {
                $planItem['plan_id'] = $new->id;
                PlanItem::create((PlanItemDTO::fromArray($planItem))->toArray());
            }

            DB::commit();

            (new PlanStoreJob($new))->handle();

            return $new;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(PlanUpdateRequest $request, mixed $id): Plan
    {
        try {
            DB::beginTransaction();

            $plan = $this->repository->find($id);
            if (! empty($request->getPlanItemFields())) {
                foreach ($plan->planItems() as $planItem) {
                    $planItem->delete();
                }

                foreach ($request->getPlanItemFields() as $planItem) {
                    $planItem['plan_id'] = $plan->id;
                    PlanItem::create((PlanItemDTO::fromArray($planItem))->toArray());
                }
            }

            DB::commit();

            (new PlanUpdateJob($plan))->handle();

            return $plan;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function plan_items(mixed $id): array
    {
        return $this->repository->find($id)->planItems()->toArray();
    }
}
