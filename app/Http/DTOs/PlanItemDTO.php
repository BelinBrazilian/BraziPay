<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PlanItemDTO extends DTO
{
    public function __construct(
        private readonly int $plan_id,
        private readonly int $product_id,
        private readonly int $pricing_schema_id,
        private readonly int $cycles
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('plan_id'),
            $request->get('product_id'),
            $request->get('pricing_schema_id'),
            $request->get('cycles'),
        );
    }

    public static function fromArray(array $data) : self
    {
        return new self(
            $data['plan_id'],
            $data['product_id'],
            $data['pricing_schema_id'],
            $data['cycles'],
        );
    }
}
