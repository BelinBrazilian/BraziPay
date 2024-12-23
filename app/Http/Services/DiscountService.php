<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\DTOs\DiscountDTO;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Repositories\DiscountRepository;
use App\Http\Requests\Discount\DiscountStoreRequest;
use App\Jobs\Discount\DiscountDeleteJob;
use App\Jobs\Discount\DiscountStoreJob;
use App\Models\Discount;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Vindi\Discount as VindiDiscount;

final class DiscountService
{
    private readonly VindiDiscount $vindiService;

    public function __construct(private readonly DiscountRepository $repository)
    {
        $this->vindiService = new VindiDiscount(VindiApi::config());
    }

    // direct functions
    public function _show(int $id): JsonResponse
    {
        return $this->vindiService->retrieve($id);
    }

    public function _store(StoreRequestInterface $request): JsonResponse
    {
        return $this->vindiService->create($request->all());
    }

    public function _destroy($id): JsonResponse
    {
        return $this->vindiService->delete($id);
    }

    // stored info functions
    public function show(int $id): Discount
    {
        return $this->repository->find($id);
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

            $discount = $this->repository->find($id);
            $external_id = $discount->external_id;
            $discount->delete();

            DB::commit();

            (new DiscountDeleteJob($external_id))->handle();

            return response()->json([], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
