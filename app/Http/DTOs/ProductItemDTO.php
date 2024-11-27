<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class ProductItemDTO extends DTO
{
    public function __construct(
        private readonly int $productId,
        private readonly int $subscriptionId,
        private readonly int $pricingSchemaId,
        private readonly ?int $cycles,
        private readonly ?int $quantity,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('product_id'),
            $request->get('subscription_id'),
            $request->get('pricing_schema_id'),
            $request->get('cycles', null),
            $request->get('quantity', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['product_id'],
            $data['subscription_id'],
            $data['pricing_schema_id'],
            $data['cycles'] ?? null,
            $data['quantity'] ?? null,
        );
    }
}
