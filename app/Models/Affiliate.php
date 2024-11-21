<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;

    protected $table = 'affiliates';

    protected $fillable = [
        'external_id',
        'login',
        'status',
        'enabled',
    ];

    public function normalize(bool $update = false) : array
    {
        if ($update) {
            return [
                'body' => $this->toJson(),
                'enabled' => $this->enabled,
            ];
        }

        return [
            'body' => $this->toJson(),
            'login' => $this->login,
            'status' => $this->status,
            'enabled' => $this->enabled,
        ];
    }
}
