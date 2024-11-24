<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'street',
        'number',
        'additional_details',
        'zipcode',
        'neighborhood',
        'city',
        'state',
        'country',
    ];

    /**
     * Get the customer associated with the address.
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Get the affiliate associated with the address.
     */
    public function affiliate(): HasOne
    {
        return $this->hasOne(Affiliate::class);
    }

    /**
     * Get the partner associated with the address.
     */
    public function partner(): HasOne
    {
        return $this->hasOne(Partner::class);
    }
}