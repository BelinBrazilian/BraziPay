<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'token',
        'holder_name',
        'registry_code',
        'bank_branch',
        'bank_account',
        'card_expiration',
        'allow_as_fallback',
        'card_number',
        'card_cvv',
        'card_token',
        'gateway_id',
        'payment_method_code',
        'payment_company_code',
        'gateway_token',
    ];

    /**
     * Get the customer that owns the payment profile.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}