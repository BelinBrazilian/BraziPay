<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Partner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address_id',
        'bank_account_id',
        'name',
        'company_name',
        'cpf',
        'cnpj',
        'user_name',
        'user_email',
        'economic_activity',
        'phone_number',
        'template_code',
    ];

    /**
     * Get the address associated with the partner.
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * Get the bank account associated with the partner.
     */
    public function bankAccount(): HasOne
    {
        return $this->hasOne(BankAccount::class);
    }
}