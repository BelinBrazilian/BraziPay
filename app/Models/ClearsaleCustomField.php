<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ClearsaleCustomField.
 *
 * This model represents a custom field (key-value pair) submitted to ClearSale.
 *
 * Fields:
 * - clearsale_order_id: Foreign key to the ClearsaleOrder.
 * - name: Custom field name.
 * - value: Custom field value.
 * - type: Numeric code representing the type of the custom field (optional).
 *
 * @package App\Models
 */
class ClearsaleCustomField extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clearsale_custom_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clearsale_order_id',
        'name',
        'value',
        'type',
    ];

    /**
     * Get the order associated with the custom field.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(ClearsaleOrder::class, 'clearsale_order_id', 'id');
    }
}
