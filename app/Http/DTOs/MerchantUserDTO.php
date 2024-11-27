<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class MerchantUserDTO extends DTO
{
    public function __construct(
        private readonly int $roleId,
        private readonly string $name,
        private readonly string $email,
        private readonly ?string $action,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('role_id'),
            $request->get('name'),
            $request->get('email'),
            $request->get('action', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['role_id'],
            $data['name'],
            $data['email'],
            $data['action'] ?? null,
        );
    }
}
