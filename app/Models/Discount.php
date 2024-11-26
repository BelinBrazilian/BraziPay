<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_item_id',
        'discount_type',
        'percentage',
        'amount',
        'quantity',
        'cycles',
    ];

    /**
     * Get the product item that owns the discount.
     */
    public function productItem(): BelongsTo
    {
        return $this->belongsTo(ProductItem::class);
    }

    public function normalize(): array
    {
        $data = [
            'body' => $this->toJson(),
            'name' => $this->name,
            'interval' => $this->interval,
            'interval_count' => $this->interval_count,
            'billing_trigger_type' => $this->billing_trigger_type,
            'billing_trigger_day' => $this->billing_trigger_day,
            'billing_cycles' => $this->billing_cycles ?? null,
            'code' => $this->code ?? null,
            'description' => $this->description ?? null,
            'installments' => $this->installments ?? null,
            'invoice_split' => $this->invoice_split ?? null,
            'status' => $this->status ?? null,
            'metadata' => 'array' ?? null,
            'plan_items' => [] ?? null,
        ];

        foreach ($this->planItems() as $planItem) {
            $data['plan_items'][] = [
                'cycles' => $planItem->cycles,
                'product_id' => $planItem->product_id,
            ];
        }

        return $data;
    }
}