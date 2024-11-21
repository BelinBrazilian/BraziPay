<?php

namespace App\Http\Services;

use App\Http\DTOs\DiscountDTO;
use App\Http\Repositories\DiscountRepository;
use App\Http\Requests\Discount\DiscountStoreRequest;
use App\Jobs\Discount\DiscountDeleteJob;
use App\Jobs\Discount\DiscountStoreJob;
use App\Models\Discount;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Vindi\Discount as VindiDiscount;

class DiscountService
{
    public function __construct(private readonly DiscountRepository $repository) {}

    public function show(int $id): Discount
    {
        return $this->repository->find($id);
    }

    public function _show(int $id): JsonResponse
    {
        $discount = $this->repository->find($id);
        $vindiDiscountService = new VindiDiscount(config('app.vindi_args'));

        return $vindiDiscountService->get($discount->external_id);
    }

    public function store(DiscountStoreRequest $request): Discount
    {
        try {
            DB::beginTransaction();

            $new = Discount::create((DiscountDTO::fromRequest($request))->toArray());

            DB::commit();

            (new DiscountStoreJob($new))->handle();

            return $new;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(mixed $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $customer = $this->repository->find($id);
            $external_id = $customer->external_id;
            $customer->delete();

            DB::commit();

            (new DiscountDeleteJob($external_id))->handle();

            return response()->json([], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
