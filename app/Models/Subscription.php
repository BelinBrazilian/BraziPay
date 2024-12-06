<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'plan_id',
        'customer_id',
        'payment_method_id',
        'payment_profile_id',
        'external_id',
        'code',
        'start_at',
        'installments',
        'billing_trigger_type',
        'billing_trigger_day',
        'billing_cycles',
        'invoice_split',
    ];

    /**
     * Get the plan that owns the subscription.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Get the customer that owns the subscription.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the payment method that owns the subscription.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the payment method that owns the subscription.
     */
    public function paymentProfile(): BelongsTo
    {
        return $this->belongsTo(PaymentProfile::class);
    }

    /**
     * Get the product items for the subscription.
     */
    public function productItems(): HasMany
    {
        return $this->hasMany(ProductItem::class);
    }

    /**
     * The affiliates that belong to the subscription.
     */
    public function affiliates(): BelongsToMany
    {
        return $this->belongsToMany(Affiliate::class)
            ->withPivot('ammount', 'amount_type', 'status', 'remove');
    }

    /**
     * Get the periods for the subscription.
     */
    public function periods(): HasMany
    {
        return $this->hasMany(Period::class);
    }

    public function normalize(): array
    {
        $data = [
            'body' => $this->toJson(),
            'code' => $this->code,
            'payment_method_code' => $this->paymentMethod->code,
            'installments' => $this->installments,
            'billing_trigger_type' => $this->billing_trigger_type,
            'billing_trigger_day' => $this->billing_trigger_day,
            'metadata' => $this->metadata ?? [],
            'payment_profile' => $this->paymentProfile->normalize(true),
            'invoice_split' => $this->invoice_split,
            'subscription_affiliates' => [],
        ];

        foreach ($this->affiliates as $affiliate) {
            $data['subscription_affiliates'][] = $affiliate->normalize(true);
        }

        return array_filter($data);
    }
}
