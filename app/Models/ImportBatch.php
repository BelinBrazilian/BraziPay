<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImportBatch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_method_id',
        'payment_company_id',
        'file_name',
        'file_path',
        'status',
    ];

    /**
     * Get the payment method that owns the import batch.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the payment company that owns the import batch.
     */
    public function paymentCompany(): BelongsTo
    {
        return $this->belongsTo(PaymentCompany::class);
    }
}
