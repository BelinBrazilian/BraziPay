<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\JsonResponse;

trait ApiDestroyTrait
{
    use HasMRRS;

    public function destroy(int $id, mixed $queryParams = null): JsonResponse
    {
        try {
            return $this->_hasService() && ($this->_hasDestroyFunction() || $this->_hasVindiDestroyFunction())
                ? $this->_service_destroy($id, $queryParams)
                : $this->_destroy($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function _destroy(int $id): JsonResponse
    {
        if (! $this->_getModelClass()) {
            throw new Exception('Model not found on '.$this::class.' class', 1);
        }

        if ($this->_hasUuid()) {
            $res = $this->model->where('id', $id)->orWhere($this->model->uuidField, $id)->first();
        } else {
            $res = $this->model->find($id);
        }

        if (empty($res->id)) {
            throw new Exception('Record not found on '.$this::class.' class', 1);
        }

        $res->delete();

        return response()->json([], 200);
    }

    private function _service_destroy(int $id, mixed $queryParams = null): JsonResponse
    {
        if ($this->_hasDestroyFunction()) {
            $this->service->destroy($id, $queryParams);
        } else {
            $this->service->_destroy($id, $queryParams);
        }

        return response()->json([], 200);
    }
}
