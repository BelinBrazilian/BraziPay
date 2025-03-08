<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Customer.
 *
 * This model represents a customer who places orders and transactions.
 *
 * Fields:
 * - name: Customer's full name.
 * - email: Customer's email address.
 * - document: Identification document.
 * - document_type: Type of document (e.g., CPF, CNPJ, PASSPORT).
 * - type: Customer type (individual or company).
 * - phone: Customer's phone number.
 *
 * @package App\Models
 */
class Customer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'document',
        'document_type',
        'type',
        'phone',
    ];

    // Define relationships if needed (e.g., orders, Pagarme cards, etc.)
}
