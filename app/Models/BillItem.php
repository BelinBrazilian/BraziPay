<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bill_id',
        'pricing_schema_id',
        'product_id',
        'product_code',
        'amount',
        'description',
        'quantity',
    ];

    /**
     * Get the bill that owns the bill item.
     */
    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }

    /**
     * Get the pricing schema that owns the bill item.
     */
    public function pricingSchema(): BelongsTo
    {
        return $this->belongsTo(PricingSchema::class);
    }

    /**
     * Get the product that owns the bill item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
