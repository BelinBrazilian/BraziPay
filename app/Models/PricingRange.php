<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Represents a pricing range within a pricing schema.
 *
 * This model defines the attributes and relationships associated
 * with a specific range of pricing for a product.
 *
 * @property int $id Unique identifier for the pricing range.
 * @property int $pricing_schema_id The ID of the associated pricing schema.
 * @property int $start_quantity Starting quantity for this pricing range.
 * @property int|null $end_quantity Ending quantity for this pricing range (optional).
 * @property float $price Price per unit or range.
 * @property float|null $overage_price Price for units exceeding this range (optional).
 * @property Carbon|null $created_at Creation timestamp.
 * @property Carbon|null $updated_at Update timestamp.
 *
 * @method static Builder|PricingRange newModelQuery()
 * @method static Builder|PricingRange newQuery()
 * @method static Builder|PricingRange query()
 */
class PricingRange extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * These attributes can be set using mass-assignment methods like
     * `create` or `fill`.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pricing_schema_id',
        'start_quantity',
        'end_quantity',
        'price',
        'overage_price',
    ];

    /**
     * Defines a many-to-one relationship with the PricingSchema model.
     *
     * This relationship indicates that a pricing range belongs to a pricing schema.
     */
    public function pricingSchema(): BelongsTo
    {
        return $this->belongsTo(PricingSchema::class);
    }

    /**
     * Normalize the pricing range data into an associative array.
     *
     * This method prepares the pricing range data in a consistent format
     * for external systems or APIs.
     *
     * @return array<string, mixed>
     */
    public function normalize(): array
    {
        return [
            'start_quantity' => $this->start_quantity,
            'end_quantity' => $this->end_quantity,
            'price' => $this->price,
            'overage_price' => $this->overage_price,
        ];
    }
}
