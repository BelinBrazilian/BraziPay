<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PricingRange extends Model
{
    use HasFactory;

    protected $table = 'pricing_ranges';

    protected $fillable = [
        'start_quantity',
        'end_quantity',
        'price',
        'overage_price',
    ];

    public function pricingSchema() : HasMany
    {
        return $this->hasMany(PricingSchema::class);
    }
}
