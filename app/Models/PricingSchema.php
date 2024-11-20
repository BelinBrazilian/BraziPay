<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PricingSchema extends Model
{
    use HasFactory;

    protected $table = 'pricing_schema';

    protected $fillable = [
        'short_format',
        'price',
        'minimum_price',
        'schema_type',
        'pricing_range_id',
    ];

    public function pricingRange() : BelongsTo
    {
        return $this->belongsTo(PricingRange::class);
    }
}
