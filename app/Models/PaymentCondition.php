<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentCondition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'penalty_fee_value',
        'penalty_fee_type',
        'daily_fee_value',
        'daily_fee_type',
        'after_due_days',
    ];

    /**
     * Get the bill associated with the payment condition.
     */
    public function bill(): HasOne
    {
        return $this->hasOne(Bill::class);
    }

    /**
     * Get the payment condition discounts associated with the payment condition.
     */
    public function paymentConditionDiscounts(): HasMany
    {
        return $this->hasMany(PaymentConditionDiscount::class);
    }
}