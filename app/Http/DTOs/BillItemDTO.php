<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class BillItemDTO extends DTO
{
    public function __construct(
        private readonly int $billId,
        private readonly ?int $pricingSchemaId,
        private readonly ?int $productId,
        private readonly ?string $productCode,
        private readonly float $amount,
        private readonly ?string $description,
        private readonly ?int $quantity,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('bill_id'),
            $request->get('pricing_schema_id', null),
            $request->get('product_id', null),
            $request->get('product_code', null),
            $request->get('amount'),
            $request->get('description', null),
            $request->get('quantity', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['bill_id'],
            $data['pricing_schema_id'] ?? null,
            $data['product_id'] ?? null,
            $data['product_code'] ?? null,
            $data['amount'],
            $data['description'] ?? null,
            $data['quantity'] ?? null,
        );
    }
}
