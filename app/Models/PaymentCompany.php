<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentCompany extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Get the export batches associated with the payment company.
     */
    public function exportBatches(): HasMany
    {
        return $this->hasMany(ExportBatch::class);
    }

    /**
     * Get the import batches associated with the payment company.
     */
    public function importBatches(): HasMany
    {
        return $this->hasMany(ImportBatch::class);
    }
}
