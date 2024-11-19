<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    use HasFactory;

    public $fillable = [
        'customer_id',
        'merchant_id',
        'phone_type',
        'number',
        'extension',
    ];

    public function customer() : BelongsTo
    {
        return $this->belongsTo('customers', 'id', 'id');
    }

    public function merchant() : BelongsTo
    {
        return $this->belongsTo('merchants', 'id', 'id');
    }
}
