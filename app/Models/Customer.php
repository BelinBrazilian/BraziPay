<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address_id',
        'external_id',
        'code',
        'name',
        'email',
        'registry_code',
        'notes',
    ];

    /**
     * Get the address associated with the customer.
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * Get the phones associated with the customer.
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    /**
     * Get the subscriptions associated with the customer.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the payment profiles associated with the customer.
     */
    public function paymentProfiles(): HasMany
    {
        return $this->hasMany(PaymentProfile::class);
    }

    /**
     * Get the messages associated with the customer.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}