<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'cpf_cnpj',
        'address',
        'email',
        'phone',
        'social_networks',
    ];

    protected $casts = [
        'social_networks' => 'array',
    ];
}