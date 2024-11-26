<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'external_id',
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

    /**
     * Get the subscription that owns the payment profile.
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    public function normalize($subscriptionPattern = false) : array
    {
        $data = [
            'holder_name' => $this->holder_name,
            'registry_code' => $this->registry_code,
            'bank_branch' => $this->bank_branch,
            'bank_account' => $this->bank_account,
            'card_expiration' => $this->card_expiration,
            'allow_as_fallback' => $this->allow_as_fallback,
            'card_number' => $this->card_number,
            'card_cvv' => $this->card_cvv,
            'payment_method_code' => $this->payment_method_code,
            'payment_company_code' => $this->payment_company_code,
            'gateway_token' => $this->gateway_token,
        ];

        if ($subscriptionPattern) {
            $data['id'] = $this->external_id;
            $data['token'] = $this->token;
            $data['card_token'] = $this->card_token;
            $data['gateway_id'] = $this->gateway_id;
        } else {
            $data['body'] = $this->toJson();
            $data['card_renewed_at'] = $this->card_renewed_at;
            $data['customer_id'] = $this->customer->external_id;
        }

        return array_filter($data);
    }
}