<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class ProductDTO extends DTO
{
    public function __construct(
        private readonly int $pricingSchemaId,
        private readonly ?int $externalId,
        private readonly string $code,
        private readonly string $name,
        private readonly ?string $unit,
        private readonly string $status,
        private readonly ?string $description,
        private readonly ?string $invoice,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('pricing_schema_id'),
            $request->get('external_id', null),
            $request->get('code'),
            $request->get('name'),
            $request->get('unit', null),
            $request->get('status'),
            $request->get('description', null),
            $request->get('invoice', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['pricing_schema_id'],
            $data['external_id'] ?? null,
            $data['code'],
            $data['name'],
            $data['unit'] ?? null,
            $data['status'],
            $data['description'] ?? null,
            $data['invoice'] ?? null,
        );
    }
}