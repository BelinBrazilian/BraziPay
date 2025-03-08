<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ClearsaleAddress.
 *
 * This model represents an address (billing or shipping) submitted to ClearSale.
 *
 * Fields:
 * - clearsale_order_id: Foreign key to the ClearsaleOrder.
 * - address_line1: Primary address information (e.g., street, number, neighborhood).
 * - address_line2: Additional address details (e.g., complement).
 * - city: City.
 * - state: State code (2 characters, e.g., "CA").
 * - zip_code: Postal code.
 * - country: Country (optional).
 *
 * @package App\Models
 */
class ClearsaleAddress extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clearsale_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clearsale_order_id',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zip_code',
        'country',
    ];

    /**
     * Get the order associated with the address.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(ClearsaleOrder::class, 'clearsale_order_id', 'id');
    }
}
