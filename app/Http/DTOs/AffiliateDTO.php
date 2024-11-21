<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class AffiliateDTO extends DTO
{
    public function __construct(
        private readonly string $login, 
        private readonly int $status, 
        private readonly string $enabled
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('login'),
            $request->get('status'),
            $request->get('enabled'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['login'],
            $data['status'],
            $data['enabled'],
        );
    }
}
