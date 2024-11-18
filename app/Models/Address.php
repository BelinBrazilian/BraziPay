<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    public $fillable = [
        'street',
        'number',
        'additional_details',
        'zipcode',
        'neighborhood',
        'city',
        'state',
        'country',
    ];

    public function customer() : BelongsTo
    {
        return $this->belongsTo('customers', 'id', 'id');
    }
}
