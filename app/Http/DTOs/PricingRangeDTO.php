<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PricingRangeDTO extends DTO
{
    public function __construct(
        private readonly int $pricingSchemaId,
        private readonly int $startQuantity,
        private readonly ?int $endQuantity,
        private readonly float $price,
        private readonly ?float $overagePrice,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('pricing_schema_id'),
            $request->get('start_quantity'),
            $request->get('end_quantity', null),
            $request->get('price'),
            $request->get('overage_price', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['pricing_schema_id'],
            $data['start_quantity'],
            $data['end_quantity'] ?? null,
            $data['price'],
            $data['overage_price'] ?? null,
        );
    }
}