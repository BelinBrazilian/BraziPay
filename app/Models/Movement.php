<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bill_id',
        'amount',
        'movement_type',
        'origin',
        'description',
    ];

    /**
     * Get the bill that owns the movement.
     */
    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }
}