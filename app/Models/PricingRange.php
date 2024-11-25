<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PricingRange extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
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
     * Get the pricing schema that owns the pricing range.
     */
    public function pricingSchema(): BelongsTo
    {
        return $this->belongsTo(PricingSchema::class);
    }
}