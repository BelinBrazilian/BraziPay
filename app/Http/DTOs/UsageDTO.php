<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class UsageDTO extends DTO
{
    public function __construct(
        private readonly int $periodId,
        private readonly ?int $productId,
        private readonly ?int $productItemId,
        private readonly ?string $description,
        private readonly ?array $metadata,
        private readonly int $quantity,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('period_id'),
            $request->get('product_id', null),
            $request->get('product_item_id', null),
            $request->get('description', null),
            $request->get('metadata', null),
            $request->get('quantity'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['period_id'],
            $data['product_id'] ?? null,
            $data['product_item_id'] ?? null,
            $data['description'] ?? null,
            $data['metadata'] ?? null,
            $data['quantity'],
        );
    }
}
