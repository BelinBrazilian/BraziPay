<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VindiConfig extends Model
{
    use HasFactory;

    // Nome da tabela
    protected $table = 'vindi_config';

    // Campos permitidos para preenchimento em massa
    protected $fillable = [
        'api_key',
        'api_uri',
    ];
}
