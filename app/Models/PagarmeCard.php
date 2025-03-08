<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PagarmeCard.
 *
 * This model represents tokenized card information from the Pagar.me API.
 *
 * Fields:
 * - customer_id: Foreign key referencing the customer (user).
 * - card_id: Unique card identifier returned by the API.
 * - last_four: Last 4 digits of the card number.
 * - brand: Card brand (e.g., Visa, Mastercard).
 * - token: Optional card token for secure transactions.
 *
 * @package App\Models
 */
class PagarmeCard extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pagarme_cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'card_id',
        'last_four',
        'brand',
        'token',
    ];

    /**
     * Get the customer that owns the card.
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        // Assuming a Customer model exists.
        return $this->belongsTo(Customer::class);
    }
}
