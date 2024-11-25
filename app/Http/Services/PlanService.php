<?php

namespace App\Http\Services;

use App\Http\DTOs\PlanDTO;
use App\Http\DTOs\PlanItemDTO;
use App\Http\Repositories\PlanRepository;
use App\Http\Requests\Plan\PlanStoreRequest;
use App\Http\Requests\Plan\PlanUpdateRequest;
use App\Integrators\Vindi\PlanItems;
use App\Jobs\Customer\PlanStoreJob;
use App\Jobs\Customer\PlanUpdateJob;
use App\Models\Plan;
use App\Models\PlanItem;
use Exception;
use Illuminate\Support\Facades\DB;

class PlanService
{
    public function __construct(private readonly PlanRepository $repository) {}

    public function plan_items(mixed $id) : array
    {
        return $this->repository->find($id)->planItems()->toArray();
    }

    public function _plan_items(mixed $id) : array
    {
        $plan = $this->repository->find($id);

        $vindiPlanItemService = new PlanItems(config('app.vindi_args'));
        return $vindiPlanItemService->plan_items($plan->external_id);
    }

    public function store(PlanStoreRequest $request) : Plan
    {
        try {
            DB::beginTransaction();

            $new = Plan::create((PlanDTO::fromRequest($request)));
            foreach($request->getPlanItemFields() as $planItem) {
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

    public function update(PlanUpdateRequest $request, mixed $id) : Plan
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
}
