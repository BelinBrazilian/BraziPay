<?php

namespace App\Http\DTOs;

abstract class DTO
{
    public function toArray(): array
    {
        return (array) $this;
    }

    public function toJson(): string
    {
        return json_encode($this->toarray());
    }
}
