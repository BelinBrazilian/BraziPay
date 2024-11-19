<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    public static $uuidField = 'code';

    public $fillable = [
        'external_id',
        'name',
        'email',
        'registry_code',
        'notes',
        'status',
        'metadata',
        'address_id',
    ];

    public function address() : HasOne
    {
        return $this->hasOne('addresses', 'id', 'address_id');
    }

    public function phones() : HasMany
    {
        return $this->hasMany('phones', 'customer_id', 'id');
    }

    public function normalize() : array
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email ?? null,
            'registry_code' => $this->registry_code ?? null,
            'code' => $this->code ?? null,
            'notes' => $this->notes ?? null,
            'metadata' => 'array' ?? null,
            'address' => null,
            'phones' => null,
        ];

        $data['address']['street'] = $this->address->street;
        $data['address']['number'] = $this->address->number;
        $data['address']['additional_details'] = $this->address->additional_details ?? null;
        $data['address']['zipcode'] = $this->address->zipcode;
        $data['address']['neighborhood'] = $this->address->neighborhood;
        $data['address']['city'] = $this->address->city;
        $data['address']['state'] = $this->address->state;
        $data['address']['country'] = $this->address->country;

        foreach($this->phones as $phone) {
            $data['phones'][] = [
                'phone_type' => $phone->phone_type,
                'number' => $phone->number,
                'extension' => $phone->extension ?? null,
            ];
        }

        $data['body'] = $this->toJson();

        return $data;
    }
}
