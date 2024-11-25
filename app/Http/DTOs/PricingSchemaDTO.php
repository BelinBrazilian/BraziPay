<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PricingSchemaDTO extends DTO
{
    public function __construct(
        private readonly float $price,
        private readonly ?float $minimumPrice,
        private readonly string $schemaType,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('price'),
            $request->get('minimum_price', null),
            $request->get('schema_type'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['price'],
            $data['minimum_price'] ?? null,
            $data['schema_type'],
        );
    }
}