<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function normalize(): array
    {
        $data = [
            'body' => $this->toJson(),
            'name' => $this->name,
            'email' => $this->email ?? null,
            'registry_code' => $this->registry_code ?? null,
            'code' => $this->code ?? null,
            'notes' => $this->notes ?? null,
            'metadata' => 'array' ?? null,
            'address' => [],
            'phones' => [],
        ];

        // Proteção contra address nulo
        $data['address'] = [
            'street' => optional($this->address)->street,
            'number' => optional($this->address)->number,
            'additional_details' => optional($this->address)->additional_details,
            'zipcode' => optional($this->address)->zipcode,
            'neighborhood' => optional($this->address)->neighborhood,
            'city' => optional($this->address)->city,
            'state' => optional($this->address)->state,
            'country' => optional($this->address)->country,
        ];

        // Proteção para phones vazio
        foreach ($this->phones as $phone) {
            $data['phones'][] = [
                'phone_type' => $phone->phone_type,
                'number' => $phone->number,
                'extension' => $phone->extension ?? null,
            ];
        }

        return $data;
    }
}
