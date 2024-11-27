<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PlanItemDTO extends DTO
{
    public function __construct(
        private readonly int $planId,
        private readonly ?int $cycles,
        private readonly int $productId,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('plan_id'),
            $request->get('cycles', null),
            $request->get('product_id'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['plan_id'],
            $data['cycles'] ?? null,
            $data['product_id'],
        );
    }
}
