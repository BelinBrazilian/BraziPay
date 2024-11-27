<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class MovementDTO extends DTO
{
    public function __construct(
        private readonly int $billId,
        private readonly float $amount,
        private readonly string $movementType,
        private readonly ?string $origin,
        private readonly ?string $description,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('bill_id'),
            $request->get('amount'),
            $request->get('movement_type'),
            $request->get('origin', null),
            $request->get('description', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['bill_id'],
            $data['amount'],
            $data['movement_type'],
            $data['origin'] ?? null,
            $data['description'] ?? null,
        );
    }
}
