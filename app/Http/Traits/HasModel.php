<?php

namespace App\Http\Traits;

trait HasModel
{
    use HasRepository;

    public function _hasModel(): bool
    {
        return empty($this->model) ? false : true;
    }

    public function _getModelClass(): ?string
    {
        if ($this->_hasModel()) {
            return $this->model::class;
        }

        if ($this->_hasRepository()) {
            $modelClass = $this->repository->modelClass;
            $this->model = new $modelClass();

            return $modelClass;
        }

        return null;
    }

    public function _hasUuid(): bool
    {
        return ! empty($this->model::uuidField) ? true : false;
    }

    public function _hasDto(): bool
    {
        $dtoName = $this->model::class . 'DTO';
        if (class_exists($dtoName)) {
            $this->dto = $dtoName;
        }

        return false;
    }

    public function _getAllowedFilters(): array
    {
        return $this->model->allowedFilters ?? $this->model->fillable;
    }

    public function _getAllowedSorts(): array
    {
        return $this->model->allowedSorts ?? $this->model->fillable;
    }

    public function _getAllowedIncludes(): array
    {
        return $this->model->allowedIncludes ?? [];
    }

    public function _getAllowedFields(): array
    {
        return $this->model->allowedFields ?? $this->model->fillable;
    }
}
