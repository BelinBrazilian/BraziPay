<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class DiscountDTO extends DTO
{
    public function __construct(
        private readonly int $productItemId,
        private readonly string $discountType,
        private readonly ?float $percentage,
        private readonly ?float $amount,
        private readonly ?int $quantity,
        private readonly ?int $cycles,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('product_item_id'),
            $request->get('discount_type'),
            $request->get('percentage', null),
            $request->get('amount', null),
            $request->get('quantity', null),
            $request->get('cycles', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['product_item_id'],
            $data['discount_type'],
            $data['percentage'] ?? null,
            $data['amount'] ?? null,
            $data['quantity'] ?? null,
            $data['cycles'] ?? null,
        );
    }
}