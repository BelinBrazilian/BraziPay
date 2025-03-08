<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ClearsaleOrderStatus.
 *
 * This model represents the status and risk score of a ClearSale order.
 *
 * Fields:
 * - clearsale_order_id: Foreign key to the ClearsaleOrder.
 * - status: ClearSale status code (e.g., APA for Automatic Approval, APM for Manual Approval, etc.).
 * - score: Risk score assigned by ClearSale (optional).
 *
 * @package App\Models
 */
class ClearsaleOrderStatus extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clearsale_order_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clearsale_order_id',
        'status',
        'score',
    ];

    /**
     * Get the order associated with the status.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(ClearsaleOrder::class, 'clearsale_order_id', 'id');
    }
}
