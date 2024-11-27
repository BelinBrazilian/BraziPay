<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\QueryBuilder\QueryBuilder;

trait ApiIndexTrait
{
    use HasMRRS;

    public function index(?string $queryParams): JsonResponse
    {
        return $this->_hasService() && $this->_hasIndexFunction() ?
            $this->_service_index($queryParams) :
            $this->_index();
    }

    private function _index(): JsonResponse
    {
        if (empty($this->search)) {
            $res = QueryBuilder::for($this->_getModelClass())
                ->allowedFilters($this->_getAllowedFilters())
                ->allowedSorts($this->_getAllowedSorts())
                ->allowedIncludes($this->_getAllowedIncludes())
                ->allowedFields($this->_getAllowedFields())
                ->paginate($this->per_page);
        } else {
            $res = ($this->_getModelClass())::search($this->search)->get();
        }

        return $this->_hasResource() ?
                $this->resource::collection($res) :
                JsonResource::collection($res);
    }

    private function _service_index(?string $queryParams): JsonResponse
    {
        $res = $this->service->index($queryParams);

        return $this->_hasResource() ?
                $this->resource::collection($res) :
                JsonResource::collection($res);
    }
}
