<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\QueryBuilder\QueryBuilder;

trait ApiShowTrait
{
    use HasMRRS;

    public function show(mixed $id): JsonResponse
    {
        try {
            return $this->_hasService() && $this->_hasShowFunction() ?
                $this->_service_show($id) :
                $this->_show($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function _show(mixed $id): JsonResponse
    {
        if (empty($this->search)) {
            $query = QueryBuilder::for($this->_getModelClass())
                ->allowedIncludes($this->_getAllowedIncludes())
                ->allowedFields($this->_getAllowedFields());

            if ($this->_hasUuid()) {
                $res = $query->where('id', $id)->orWhere($this->model->uuidField, $id)->first();
            } else {
                $res = $query->find($id);
            }

            if (empty($res->id)) {
                throw new Exception('Record not found on '.$this::class.' class', 1);
            }
        } else {
            $res = ($this->_getModelClass())::search($this->search)->findOrFail($id);
        }

        return $this->_hasResource() ?
            new ($this->resource::class)($res) :
            new JsonResource($res);
    }

    private function _service_show(mixed $id): JsonResponse
    {
        return $this->_hasResource() ?
            new ($this->resource::class)($this->service->show($id)) :
            new JsonResource($this->service->show($id));
    }
}
