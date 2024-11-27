<?php

namespace App\Http\Traits;

trait HasRepository
{
    public function _hasRepository(): bool
    {
        return empty($this->repository) ? false : true;
    }
}
