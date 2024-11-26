<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Affiliate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address_id',
        'bank_account_id',
        'login',
        'status',
        'enabled',
        'name',
        'cpf',
        'cnpj',
        'trade_name',
        'company_name',
        'phone',
    ];

    /**
     * Get the address associated with the affiliate.
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * Get the bank account associated with the affiliate.
     */
    public function bankAccount(): HasOne
    {
        return $this->hasOne(BankAccount::class);
    }

    /**
     * The bills that belong to the affiliate.
     */
    public function bills(): BelongsToMany
    {
        return $this->belongsToMany(Bill::class, 'bill_affiliates');
    }

    /**
     * The subscriptions that belong to the affiliate.
     */
    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class)
                    ->withPivot('ammount', 'amount_type', 'status', 'remove');
    }

    public function normalize($subscriptionPattern = false) :  array
    {
        $data = [
            'body' => $this->toJson(),
            'login' => $this->login,
            'status' => $this->status,
            'enabled' => $this->enabled,
        ];

        if ($subscriptionPattern) {
            $data = [
                'affiliate_id' => $this->external_id,
                'amount' => $this->subscriptions->amount,
                'amount_type' => $this->subscriptions->amount_type,
                'status' => $this->subscriptions->status,
                'id' => $this->subscriptions->external_id,
                'remove' => $this->subscriptions->remove,
            ];
        }

        return array_filter($data);
    }
}