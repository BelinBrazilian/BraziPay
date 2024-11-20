<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PricingSchemaDTO extends DTO
{
    public function __construct(
        private readonly ?string $short_format = null,
        private readonly float $price,
        private readonly float $minimum_price,
        private readonly string $schema_type,
        private readonly int $pricing_range_id,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('short_format', null),
            $request->get('price'),
            $request->get('minimum_price'),
            $request->get('schema_type'),
            $request->get('pricing_range_id'),
        );
    }

    public static function fromArray(array $data) : self
    {
        return new self(
            $data['short_format'] ?? null,
            $data['price'],
            $data['minimum_price'],
            $data['schema_type'],
            $data['pricing_range_id'],
        );
    }
}
