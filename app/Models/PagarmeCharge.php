<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PagarmeCharge.
 *
 * This model represents a charge record from the Pagar.me API.
 *
 * Fields:
 * - order_id: Foreign key to the orders table.
 * - charge_id: Unique charge identifier returned by the Pagar.me API.
 * - amount: Monetary amount in the smallest currency unit with 4 decimal places.
 * - status: Charge status (e.g., pending, paid, canceled, processing, failed, overpaid, underpaid, chargedback).
 * - payment_method: Payment method used (e.g., credit_card, boleto, pix, voucher, bank_transfer, safetypay, checkout, cash, private_label, debit_card).
 * - gateway_id: Optional gateway-specific identifier.
 *
 * @package App\Models
 */
class PagarmeCharge extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pagarme_charges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'charge_id',
        'amount',
        'status',
        'payment_method',
        'gateway_id',
    ];

    /**
     * Get the order that owns the charge.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        // Assuming an Order model exists in your application.
        return $this->belongsTo(Order::class);
    }
}
