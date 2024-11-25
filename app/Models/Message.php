<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'charge_id',
        'notification_id',
        'email',
    ];

    /**
     * Get the customer that owns the message.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}