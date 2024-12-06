<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class CustomerDTO extends DTO
{
    public function __construct(
        private readonly ?int $addressId,
        private readonly ?int $externalId,
        private readonly string $code,
        private readonly string $name,
        private readonly ?string $email,
        private readonly ?string $registryCode,
        private readonly ?string $notes,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('address_id', null),
            $request->get('external_id', null),
            $request->get('code'),
            $request->get('name'),
            $request->get('email', null),
            $request->get('registry_code', null),
            $request->get('notes', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['address_id'] ?? null,
            $data['external_id'] ?? null,
            $data['code'],
            $data['name'],
            $data['email'] ?? null,
            $data['registry_code'] ?? null,
            $data['notes'] ?? null,
        );
    }
}
