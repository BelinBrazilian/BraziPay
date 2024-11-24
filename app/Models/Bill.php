<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'payment_method_id',
        'payment_profile_id',
        'payment_condition_id',
        'external_id',
        'code',
        'installments',
        'billing_at',
        'due_at',
        'brand_tid',
    ];

    /**
     * Get the customer that owns the bill.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the payment method that owns the bill.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the payment profile that owns the bill.
     */
    public function paymentProfile(): BelongsTo
    {
        return $this->belongsTo(PaymentProfile::class);
    }

    /**
     * Get the payment condition that owns the bill.
     */
    public function paymentCondition(): BelongsTo
    {
        return $this->belongsTo(PaymentCondition::class);
    }

    /**
     * Get the bill items for the bill.
     */
    public function billItems(): HasMany
    {
        return $this->hasMany(BillItem::class);
    }

    /**
     * The affiliates that belong to the bill.
     */
    public function affiliates(): BelongsToMany
    {
        return $this->belongsToMany(Affiliate::class, 'bill_affiliates');
    }

    /**
     * Get the movements for the bill.
     */
    public function movements(): HasMany
    {
        return $this->hasMany(Movement::class);
    }

    /**
     * Get the invoice associated with the bill.
     */
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }
} 