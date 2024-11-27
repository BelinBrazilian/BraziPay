<?php

namespace App\Models;

use App\Http\Enums\ProductInvoiceEnum;
use App\Http\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * Represents a product in the system.
 *
 * @property int $id Unique identifier of the product.
 * @property string|null $external_id External identifier of the product.
 * @property string $name Name of the product.
 * @property string|null $code Product code.
 * @property string|null $unit Unit of measurement for the product.
 * @property ProductStatusEnum $status Current status of the product.
 * @property string|null $description Detailed description of the product.
 * @property ProductInvoiceEnum $invoice Indicates if the product generates invoices.
 * @property array|null $metadata Additional metadata for the product.
 * @property Carbon|null $created_at Creation timestamp.
 * @property Carbon|null $updated_at Update timestamp.
 * @property PricingSchema $pricingSchema
 *
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
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
        'metadata' => 'array',
        'status' => ProductStatusEnum::class,
        'invoice' => ProductInvoiceEnum::class,
    ];

    /**
     * Accessor and mutator for the 'status' attribute using ProductStatusEnum.
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ProductStatusEnum::from($value),
            set: fn ($value) => $value instanceof ProductStatusEnum ? $value->value : ProductStatusEnum::from($value)->value
        );
    }

    /**
     * Accessor and mutator for the 'invoice' attribute using ProductInvoiceEnum.
     */
    protected function invoice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ProductInvoiceEnum::from($value),
            set: fn ($value) => $value instanceof ProductInvoiceEnum ? $value->value : ProductInvoiceEnum::from($value)->value
        );
    }

    /**
     * Defines a one-to-one relationship with the PricingSchema model.
     */
    public function pricingSchema(): HasOne
    {
        return $this->hasOne(PricingSchema::class);
    }

    /**
     * Defines a many-to-many relationship with the PricingRange model via PricingSchema.
     */
    public function pricingRanges(): HasManyThrough
    {
        return $this->hasManyThrough(PricingRange::class, PricingSchema::class);
    }

    /**
     * Normalizes the product data into an associative array.
     */
    public function normalize(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'unit' => $this->unit,
            'status' => $this->status,
            'description' => $this->description,
            'invoice' => $this->invoice,
            'pricing_schema' => $this->pricingSchema->normalize(),
            'metadata' => $this->metadata,
        ];
    }
}
