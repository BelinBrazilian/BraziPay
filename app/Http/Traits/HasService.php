<?php

namespace App\Http\Traits;

trait HasService
{
    public function _hasService(): bool
    {
        return empty($this->service) ? false : true;
    }

    public function _hasIndexFunction(): bool
    {
        return method_exists($this->service::class, 'index');
    }

    public function _hasShowFunction(): bool
    {
        return method_exists($this->service::class, 'show');
    }

    public function _hasStoreFunction(): bool
    {
        return method_exists($this->service::class, 'store');
    }

    public function _hasUpdateFunction(): bool
    {
        return method_exists($this->service::class, 'update');
    }

    public function _hasDestroyFunction(): bool
    {
        return method_exists($this->service::class, 'destroy');
    }

    public function _hasVindiIndexFunction(): bool
    {
        return method_exists($this->service::class, '_index');
    }

    public function _hasVindiShowFunction(): bool
    {
        return method_exists($this->service::class, '_show');
    }

    public function _hasVindiStoreFunction(): bool
    {
        return method_exists($this->service::class, '_store');
    }

    public function _hasVindiUpdateFunction(): bool
    {
        return method_exists($this->service::class, '_update');
    }

    public function _hasVindiDestroyFunction(): bool
    {
        return method_exists($this->service::class, '_destroy');
    }
}
