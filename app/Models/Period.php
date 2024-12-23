<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'subscription_id',
        'billing_at',
        'cycle',
        'start_at',
        'end_at',
        'duration',
    ];

    /**
     * Get the subscription that owns the period.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
