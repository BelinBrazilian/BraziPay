<?php

namespace App\Http\DTOs;

use App\Http\Enums\ProductInvoiceEnum;
use App\Http\Enums\ProductStatusEnum;

/**
 * Data Transfer Object for Product.
 *
 * This DTO encapsulates details of a product, including metadata, status,
 * invoice type, and associated pricing schema, with methods to create
 * instances from arrays or request data.
 */
class ProductDTO extends DTO
{
    /**
     * ProductDTO constructor.
     *
     * @param  int  $id  The unique identifier for the product.
     * @param  string  $name  The name of the product.
     * @param  string  $code  A unique code for the product.
     * @param  string  $unit  The unit of measurement for the product.
     * @param  ProductStatusEnum  $status  The status of the product, represented as an enum.
     * @param  string  $description  A description of the product.
     * @param  ProductInvoiceEnum  $invoice  The invoice type for the product, as an enum.
     * @param  string  $createdAt  The creation timestamp of the product.
     * @param  string  $updatedAt  The last update timestamp of the product.
     * @param  PricingSchemaDTO  $pricingSchema  The pricing schema associated with the product.
     * @param  array  $metadata  Additional metadata for the product.
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $code,
        public readonly string $unit,
        public readonly ProductStatusEnum $status,
        public readonly string $description,
        public readonly ProductInvoiceEnum $invoice,
        public readonly string $createdAt,
        public readonly string $updatedAt,
        public readonly PricingSchemaDTO $pricingSchema,
        public readonly array $metadata
    ) {}

    /**
     * Create a new ProductDTO instance from request data.
     *
     * @param  array<string, mixed>  $data  The request data containing product attributes.
     */
    public static function fromRequest(array $data): self
    {
        return self::fromArray($data);
    }

    /**
     * Create a new ProductDTO instance from an array.
     *
     * This method converts structured data arrays into a ProductDTO
     * instance, useful for populating the DTO from database records or
     * external data sources.
     *
     * @param  array<string, mixed>  $data  The array containing product attributes.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['code'],
            $data['unit'],
            ProductStatusEnum::from($data['status']),
            $data['description'],
            ProductInvoiceEnum::from($data['invoice']),
            $data['created_at'],
            $data['updated_at'],
            PricingSchemaDTO::fromArray($data['pricing_schema']),
            $data['metadata'] ?? []
        );
    }
}
