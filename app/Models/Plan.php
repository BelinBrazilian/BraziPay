<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'external_id',
        'code',
        'name',
        'interval',
        'interval_count',
        'billing_trigger_type',
        'billing_trigger_day',
        'billing_cycles',
        'description',
        'installments',
        'invoice_split',
        'status',
    ];

    /**
     * Get the subscriptions for the plan.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the plan items for the plan.
     */
    public function planItems(): HasMany
    {
        return $this->hasMany(PlanItem::class);
    }
}