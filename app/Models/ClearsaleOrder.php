<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class ClearsaleOrder.
 *
 * This model represents an order sent to ClearSale for fraud analysis.
 *
 * Fields:
 * - order_id: Internal order identifier.
 * - clearsale_order_id: Order identifier returned by ClearSale (if applicable).
 * - date: Date and time when the order was sent for analysis.
 * - email: Customer email.
 * - total_items: Total value of items.
 * - total_order: Total order value (items + additional charges).
 * - total_shipping: Shipping cost (optional).
 * - currency: Currency code (ISO 4217, e.g., BRL, USD).
 * - ip: Originating IP address.
 * - origin: Order source (e.g., Mobile, Web).
 * - session_id: Unique session identifier.
 * - reanalysis: Boolean flag indicating if the order is a reanalysis.
 *
 * Relationships:
 * - orderStatus: Has one status record.
 * - payments: Has many payment records.
 * - addresses: Has many address records.
 * - items: Has many item records.
 * - customFields: Has many custom field records.
 *
 * @package App\Models
 */
class ClearsaleOrder extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clearsale_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'clearsale_order_id',
        'date',
        'email',
        'total_items',
        'total_order',
        'total_shipping',
        'currency',
        'ip',
        'origin',
        'session_id',
        'reanalysis',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'total_items' => 'decimal:4',
        'total_order' => 'decimal:4',
        'total_shipping' => 'decimal:4',
        'reanalysis' => 'boolean',
    ];

    /**
     * Get the status associated with the order.
     *
     * @return HasOne
     */
    public function orderStatus(): HasOne
    {
        return $this->hasOne(ClearsaleOrderStatus::class, 'clearsale_order_id', 'id');
    }

    /**
     * Get all payments associated with the order.
     *
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(ClearsalePayment::class, 'clearsale_order_id', 'id');
    }

    /**
     * Get all addresses associated with the order.
     *
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(ClearsaleAddress::class, 'clearsale_order_id', 'id');
    }

    /**
     * Get all items associated with the order.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(ClearsaleItem::class, 'clearsale_order_id', 'id');
    }

    /**
     * Get all custom fields associated with the order.
     *
     * @return HasMany
     */
    public function customFields(): HasMany
    {
        return $this->hasMany(ClearsaleCustomField::class, 'clearsale_order_id', 'id');
    }
}
