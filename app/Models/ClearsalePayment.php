<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ClearsalePayment.
 *
 * This model represents a payment record submitted to ClearSale for fraud analysis.
 *
 * Fields:
 * - clearsale_order_id: Foreign key to the ClearsaleOrder.
 * - payment_date: Payment submission date.
 * - card_type: Numeric code representing the card type (e.g., 1 for Diners, 2 for MasterCard, etc.).
 * - card_expiration_date: Card expiration date.
 * - type: Numeric code for the payment method (refer to ClearSale Payment Method mapping).
 * - card_holder_name: Name of the cardholder.
 * - card_end_number: Last 4 digits of the card.
 * - card_bin: First 6 digits of the card (BIN).
 * - amount: Payment amount with 4 decimal places.
 *
 * @package App\Models
 */
class ClearsalePayment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clearsale_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clearsale_order_id',
        'payment_date',
        'card_type',
        'card_expiration_date',
        'type',
        'card_holder_name',
        'card_end_number',
        'card_bin',
        'amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:4',
    ];

    /**
     * Get the order associated with the payment.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(ClearsaleOrder::class, 'clearsale_order_id', 'id');
    }
}
