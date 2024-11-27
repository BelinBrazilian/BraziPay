<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'subscription_id',
        'pricing_schema_id',
        'cycles',
        'quantity',
    ];

    /**
     * Get the product that owns the product item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the subscription that owns the product item.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Get the pricing schema that owns the product item.
     */
    public function pricingSchema(): BelongsTo
    {
        return $this->belongsTo(PricingSchema::class);
    }

    /**
     * Get the discounts for the product item.
     */
    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }

    /**
     * Get the usages for the product item.
     */
    public function usages(): HasMany
    {
        return $this->hasMany(Usage::class);
    }
}
