<?php

namespace App\Http\DTOs;

/**
 * Data Transfer Object for Pricing Range.
 *
 * This DTO encapsulates the details of a pricing range, providing
 * convenient methods to create instances from arrays or request data.
 */
class PricingRangeDTO extends DTO
{
    /**
     * PricingRangeDTO constructor.
     *
     * @param  string  $id  The unique identifier for the pricing range.
     * @param  float  $start_quantity  The starting quantity for the range.
     * @param  float  $end_quantity  The ending quantity for the range.
     * @param  float  $price  The price associated with the range.
     * @param  float  $overage_price  The overage price for quantities beyond the range.
     */
    public function __construct(
        public readonly string $id,
        public readonly float $start_quantity,
        public readonly float $end_quantity,
        public readonly float $price,
        public readonly float $overage_price,
    ) {}

    /**
     * Create a new PricingRangeDTO instance from request data.
     *
     * @param  array<string, mixed>  $data  The request data containing pricing range attributes.
     */
    public static function fromRequest(array $data): self
    {
        return self::fromArray($data);
    }

    /**
     * Create a new PricingRangeDTO instance from an array.
     *
     * This method is primarily used for instantiating the DTO from
     * a structured data array, typically sourced from a database or
     * external service.
     *
     * @param  array<string, mixed>  $data  The array containing pricing range attributes.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['start_quantity'],
            $data['end_quantity'],
            $data['price'],
            $data['overage_price']
        );
    }
}
