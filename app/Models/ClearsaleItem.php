<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ClearsaleItem.
 *
 * This model represents an item included in a ClearSale order.
 *
 * Fields:
 * - clearsale_order_id: Foreign key to the ClearsaleOrder.
 * - product_id: Product identifier.
 * - product_title: Product title.
 * - price: Unit price with 4 decimal places.
 * - quantity: Quantity purchased.
 * - category: Product category (optional).
 *
 * @package App\Models
 */
class ClearsaleItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clearsale_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clearsale_order_id',
        'product_id',
        'product_title',
        'price',
        'quantity',
        'category',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:4',
    ];

    /**
     * Get the order associated with the item.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(ClearsaleOrder::class, 'clearsale_order_id', 'id');
    }
}
