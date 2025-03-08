<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Order.
 *
 * This model represents a checkout order.
 *
 * Fields:
 * - total: The total order amount.
 * - status: The order status (e.g., pending, paid, failed).
 * - payment_id: The payment transaction ID from Pagar.me.
 *
 * Relationships:
 * - user: The user (customer) who placed the order.
 *
 * @package App\Models
 */
class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_id',
    ];

    /**
     * Get the user who placed the order.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
