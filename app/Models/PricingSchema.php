<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * Represents the pricing schema for products in the system.
 *
 * This model defines the relationships and attributes associated with
 * a pricing schema, including its connection to pricing ranges, products,
 * and other related entities.
 *
 * @property int $id Unique identifier for the pricing schema.
 * @property float|null $price Base price of the pricing schema.
 * @property float|null $minimum_price Minimum price allowed for the pricing schema.
 * @property string|null $schema_type Type of pricing schema (e.g., 'flat').
 * @property Carbon|null $created_at Creation timestamp.
 * @property Carbon|null $updated_at Update timestamp.
 * @property Product $product
 * @property HasMany $pricingRanges
 *
 * @method static Builder|PricingSchema newModelQuery()
 * @method static Builder|PricingSchema newQuery()
 * @method static Builder|PricingSchema query()
 */
class PricingSchema extends Model
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
        'price',
        'minimum_price',
        'schema_type',
    ];

    /**
     * Defines a one-to-one relationship with the Product model.
     *
     * This relationship indicates that a pricing schema is owned by a product.
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }

    /**
     * Defines a one-to-many relationship with the PricingRange model.
     *
     * This relationship represents the ranges of pricing within the schema.
     */
    public function pricingRanges(): HasMany
    {
        return $this->hasMany(PricingRange::class);
    }

    /**
     * Defines a one-to-many relationship with the ProductItem model.
     *
     * This relationship represents the product items associated with the pricing schema.
     */
    public function productItems(): HasMany
    {
        return $this->hasMany(ProductItem::class);
    }

    /**
     * Defines a one-to-many relationship with the BillItem model.
     *
     * This relationship represents the bill items linked to the pricing schema.
     */
    public function billItems(): HasMany
    {
        return $this->hasMany(BillItem::class);
    }

    public function normalize(): array
    {
        return [
            'price' => $this?->price,
            'minimum_price' => $this?->minimum_price,
            'schema_type' => $this?->schema_type,
            'pricing_ranges' => $this?->pricingRanges?->chunkMap(fn (PricingRange $range) => $range->normalize(), $this->pricingRanges()->count()),
        ];
    }
}
