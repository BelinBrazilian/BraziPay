<?php

namespace App\Http\DTOs;

class CustomerDTO extends DTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $registryCode,
        public readonly ?string $notes,
        public readonly ?string $metadata,
        public readonly ?int $addressId,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            $request->get('name'),
            $request->get('email'),
            $request->get('registry_code'),
            $request->get('notes'),
            $request->get('metadata'),
            $request->get('address_id'),
        );
    }
}
