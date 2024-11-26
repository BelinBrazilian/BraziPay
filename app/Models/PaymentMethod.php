<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PaymentMethod extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'public_name',
        'name',
        'code',
        'type',
        'status',
        'settings',
        'set_subscription_on_success',
        'allow_as_alternative',
        'maximum_attempts'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * Get the subscriptions that use this payment method.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the transactions that use this payment method.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the export batches that use this payment method.
     */
    public function exportBatches(): HasMany
    {
        return $this->hasMany(ExportBatch::class);
    }

    /**
     * Get the import batches that use this payment method.
     */
    public function importBatches(): HasMany
    {
        return $this->hasMany(ImportBatch::class);
    }

    /**
     * The payment companies that belong to the payment method.
     */
    public function paymentCompanies(): BelongsToMany
    {
        return $this->belongsToMany(PaymentCompany::class);
    }
}