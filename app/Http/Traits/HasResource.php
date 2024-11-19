<?php

namespace App\Http\Traits;

trait HasResource
{
    public function _hasResource() : bool
    {
        return empty($this->resource) ? false : true;
    }
}
