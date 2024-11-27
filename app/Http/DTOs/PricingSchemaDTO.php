<?php

namespace App\Http\DTOs;

use App\Http\Enums\SchemaTypeEnum;

/**
 * Data Transfer Object for Pricing Schema.
 *
 * This DTO encapsulates the details of a pricing schema, including
 * its type, pricing range details, and other attributes, with methods
 * for creating instances from arrays or request data.
 */
class PricingSchemaDTO extends DTO
{
    /**
     * PricingSchemaDTO constructor.
     *
     * @param  string  $id  The unique identifier for the pricing schema.
     * @param  string  $shortFormat  A short description or format string.
     * @param  float  $price  The base price for the schema.
     * @param  float|null  $minimumPrice  The minimum price, if applicable.
     * @param  SchemaTypeEnum  $schemaType  The type of schema, represented as an enum.
     * @param  array  $pricingRanges  An array of PricingRangeDTO instances.
     * @param  string  $createdAt  The creation timestamp of the schema.
     */
    public function __construct(
        public readonly string $id,
        public readonly string $shortFormat,
        public readonly float $price,
        public readonly ?float $minimumPrice,
        public readonly SchemaTypeEnum $schemaType,
        public readonly array $pricingRanges,
        public readonly string $createdAt
    ) {}

    /**
     * Create a new PricingSchemaDTO instance from request data.
     *
     * @param  array<string, mixed>  $data  The request data containing pricing schema attributes.
     */
    public static function fromRequest(array $data): self
    {
        return self::fromArray($data);
    }

    /**
     * Create a new PricingSchemaDTO instance from an array.
     *
     * This method converts structured data arrays into a PricingSchemaDTO
     * instance, useful for populating the DTO from database records or
     * external data sources.
     *
     * @param  array<string, mixed>  $data  The array containing pricing schema attributes.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['short_format'],
            $data['price'],
            $data['minimum_price'] ?? null,
            SchemaTypeEnum::from($data['schema_type']),
            array_map(fn ($range) => PricingRangeDTO::fromArray($range), $data['pricing_ranges'] ?? []),
            $data['created_at']
        );
    }
}
