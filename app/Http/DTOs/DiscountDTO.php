<?php

namespace App\Http\DTOs;

use App\Http\Enums\DiscountTypeEnum;
use App\Http\Requests\Discount\DiscountStoreRequest;
use InvalidArgumentException;

class DiscountDTO extends DTO
{
    public function __construct(
        private readonly int $product_item_id,
        private readonly DiscountTypeEnum $discount_type,
        private readonly ?float $percentage = null,
        private readonly ?float $amount = null,
        private readonly ?int $quantity = null,
        private readonly ?int $cycles = null
    ) {
        if ($discount_type === DiscountTypeEnum::Percentage->value && is_null($percentage)) {
            throw new InvalidArgumentException('Percentage cannot be null when discount type is percentage.');
        }

        if ($discount_type === DiscountTypeEnum::Amount->value && is_null($amount)) {
            throw new InvalidArgumentException('Amount cannot be null when discount type is amount.');
        }

        if ($discount_type === DiscountTypeEnum::Quantity->value && is_null($quantity)) {
            throw new InvalidArgumentException('Quantity cannot be null when discount type is quantity.');
        }
    }

    public static function fromRequest(DiscountStoreRequest $request): self
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
