<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingSchema extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
        'minimum_price',
        'schema_type',
    ];

    /**
     * Get the product that owns the pricing schema.
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }

    /**
     * Get the pricing ranges for the pricing schema.
     */
    public function pricingRanges(): HasMany
    {
        return $this->hasMany(PricingRange::class);
    }

    /**
     * Get the product items for the pricing schema.
     */
    public function productItems(): HasMany
    {
        return $this->hasMany(ProductItem::class);
    }

    /**
     * Get the bill items for the pricing schema.
     */
    public function billItems(): HasMany
    {
        return $this->hasMany(BillItem::class);
    }
}