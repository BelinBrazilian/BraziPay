<?php

namespace App\Http\Enums;

/**
 * Enum SchemaTypeEnum.
 *
 * Represents the types of pricing schemas available for a product. This enum
 * ensures consistency in handling schema types across the application.
 */
enum SchemaTypeEnum: string
{
    /**
     * Flat pricing schema, indicating a single price applied across all quantities.
     *
     * @var string
     */
    case Flat = 'flat';

    /**
     * Tiered pricing schema, indicating that different prices apply based on quantity ranges.
     *
     * @var string
     */
    case Tiered = 'tiered';

    case PerUnit = 'per_unit';
    case StepUsage = 'step_usage';
    case VolumeUsage = 'volume_usage';
    case TierUsage = 'tier_usage';
}
