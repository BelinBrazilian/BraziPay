<?php

namespace App\Http\Traits;

use App\Http\Interfaces\UpdateRequestInterface;
use Exception;
use Illuminate\Http\JsonResponse;

trait ApiUpdateTrait
{
    use HasMRRS;

    public function update(UpdateRequestInterface $request, mixed $id): JsonResponse
    {
        try {
            return $this->_hasService() && ($this->_hasUpdateFunction() || $this->_hasVindiUpdateFunction()) ?
                $this->_service_update($request, $id) :
                $this->_update($request, $id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function _update(UpdateRequestInterface $request, mixed $id): JsonResponse
    {
        if (! $this->_getModelClass()) {
            throw new Exception('Model not found on ' . $this::class . ' class', 1);
        }

        if ($this->_hasUuid()) {
            $res = $this->model->where('id', $id)->orWhere($this->model->uuidField, $id)->first();
        } else {
            $res = $this->model->find($id);
        }

        if (empty($res->id)) {
            throw new Exception('Record not found on ' . $this::class . ' class', 1);
        }

        $data = $this->_hasDto() ? ($this->dto::fomRequest($request))->toArray() : $request->all();
        if ($res->update($data)) {
            return response()->json([], 200);
        }

        throw new Exception('Error on "update": ' . $this::class . ' class', 1);
    }

    private function _service_update(UpdateRequestInterface $request, mixed $id): JsonResponse
    {
        if ($this->_hasUpdateFunction()) {
            $this->service->update($request, $id);
        } else {
            $this->service->_update($request, $id);
        }

        return response()->json([], 200);
    }
}
