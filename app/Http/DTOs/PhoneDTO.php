<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PhoneDTO extends DTO
{
    public function __construct(
        private readonly int $customerId,
        private readonly string $phoneType,
        private readonly string $number,
        private readonly ?string $extension,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('customer_id'),
            $request->get('phone_type'),
            $request->get('number'),
            $request->get('extension', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['customer_id'],
            $data['phone_type'],
            $data['number'],
            $data['extension'] ?? null,
        );
    }
}
