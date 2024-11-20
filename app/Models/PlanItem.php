<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanItem extends Model
{
    use HasFactory;

    protected $table = 'plan_items';

    protected $fillable = [
        'plan_id',
        'product_id',
        'pricing_schema_id',
        'cycles',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function pricingSchema()
    {
        return $this->belongsTo(PricingSchema::class);
    }
}
