<?php

namespace App\Http\Enums;

/**
 * Enum ProductInvoiceEnum.
 *
 * Represents the possible invoice types for a product. This enum provides
 * a standardized way to handle invoice type values, ensuring consistency
 * across the application.
 */
enum ProductInvoiceEnum: string
{
    /**
     * Indicates that the invoice is always required for the product.
     *
     * @var string
     */
    case Always = 'always';

    /**
     * Indicates that the invoice is only required on demand for the product.
     *
     * @var string
     */
    case OnDemand = 'on_demand';
}
