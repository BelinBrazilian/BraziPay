<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BankAccount extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bank_code',
        'bank_branch',
        'account_number',
        'account_digit',
    ];

    /**
     * Get the affiliate associated with the bank account.
     */
    public function affiliate(): HasOne
    {
        return $this->hasOne(Affiliate::class);
    }

    /**
     * Get the partner associated with the bank account.
     */
    public function partner(): HasOne
    {
        return $this->hasOne(Partner::class);
    }
}