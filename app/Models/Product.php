<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pricing_schema_id',
        'external_id',
        'code',
        'name',
        'unit',
        'status',
        'description',
        'invoice',
    ];

    /**
     * Get the pricing schema associated with the product.
     */
    public function pricingSchema(): HasOne
    {
        return $this->hasOne(PricingSchema::class);
    }

    /**
     * Get the product items for the product.
     */
    public function productItems(): HasMany
    {
        return $this->hasMany(ProductItem::class);
    }

    /**
     * Get the plan items for the product.
     */
    public function planItems(): HasMany
    {
        return $this->hasMany(PlanItem::class);
    }

    /**
     * Get the bill items for the product.
     */
    public function billItems(): HasMany
    {
        return $this->hasMany(BillItem::class);
    }

    /**
     * Get the usages for the product.
     */
    public function usages(): HasMany
    {
        return $this->hasMany(Usage::class);
    }
}