<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Http\Enums\ProductStatusEnum;
use App\Http\Enums\ProductInvoiceEnum;

/**
 * Product Model representing the products table.
 *
 * This model includes properties and methods for handling
 * Product-specific data and attributes.
 *
 * @package App\Models
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'external_id',
        'name',
        'code',
        'unit',
        'status',
        'description',
        'invoice',
        'metadata',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'json',
        'status' => ProductStatusEnum::class,
        'invoice' => ProductInvoiceEnum::class,
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get and set the status attribute using the ProductStatusEnum.
     *
     * This accessor and mutator ensure that the status value is always
     * an instance of ProductStatusEnum, allowing for easy status handling
     * within the model.
     *
     * @return Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ProductStatusEnum::from($value),
            set: fn ($value) => $value instanceof ProductStatusEnum ? $value->value : ProductStatusEnum::from($value)->value
        );
    }

    /**
     * Get and set the invoice attribute using the ProductInvoiceEnum.
     *
     * This accessor and mutator ensure that the invoice value is always
     * an instance of ProductInvoiceEnum, allowing for easy handling of
     * invoice data within the model.
     *
     * @return Attribute
     */
    protected function invoice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ProductInvoiceEnum::from($value),
            set: fn ($value) => $value instanceof ProductInvoiceEnum ? $value->value : ProductInvoiceEnum::from($value)->value
        );
    }
}
