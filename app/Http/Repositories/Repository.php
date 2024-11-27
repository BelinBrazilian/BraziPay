<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class Repository
{
    protected ?string $modelClass;

    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function find(mixed $id): Model
    {
        try {
            if ($uuidField = $this->modelClass::uuidField) {
                $res = $this->modelClass::where('id', $id)->orWhere($uuidField, $id)->first();

                if (empty($res->id)) {
                    throw new Exception('Record not found on '.$this::class.' class', 1);
                }

                return $res;
            }

            return ($this->modelClass)::findOrFail($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function all(): Collection
    {
        try {
            return ($this->modelClass)::all();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreRequestInterface $request): JsonResponse
    {
        try {
            $dtoName = $this->modelClass.'DTO';
            if (class_exists($dtoName)) {
                return ($this->modelClass)::create(($dtoName::fromRequest($request))->toArray());
            }

            return ($this->modelClass)::create($request->all());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRequestInterface $request, mixed $id): JsonResponse
    {
        try {
            $res = $this->find($id);

            $dtoName = $this->modelClass.'DTO';
            if (class_exists($dtoName)) {
                return $res->update($dtoName::fromRequest($request)->toArray());
            }

            return $res->update($request->all());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(mixed $id): JsonResponse
    {
        try {
            $res = $this->find($id);

            return $res->delete();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
