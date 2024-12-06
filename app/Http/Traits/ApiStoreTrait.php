<?php

namespace App\Http\Traits;

use App\Http\Interfaces\StoreRequestInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait ApiStoreTrait
{
    use HasMRRS;

    public function store(StoreRequestInterface $request): JsonResponse
    {
        try {
            return $this->_hasService() && ($this->_hasStoreFunction() || $this->_hasVindiStoreFunction()) ?
                $this->_service_store($request) :
                $this->_store($request);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function _store(StoreRequestInterface $request): JsonResponse
    {
        $data = $this->_hasDto() ? ($this->dto::fomRequest($request))->toArray() : $request->all();
        if ($stored = ($this->_getModelClass())::create($data)) {
            return $this->_hasResource() ?
                new ($this->resource::class)($stored) :
                new JsonResource($stored);
        }

        throw new Exception('Error on "store": ' . $this::class . ' class', 1);
    }

    private function _service_store(StoreRequestInterface $request): JsonResponse
    {
        if ($this->_hasStoreFunction()) {
            $stored = $this->service->store($request);
        } else {
            $stored = $this->service->_store($request);
        }

        return $this->_hasResource() ?
            new ($this->resource::class)($stored) :
            new JsonResource($stored);
    }
}
