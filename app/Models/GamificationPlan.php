<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class GamificationPlan.
 *
 * This model defines the rules for awarding points for specific actions.
 *
 * Fields:
 * - action: Unique identifier for the gamification action (e.g., "order_completed").
 * - points: The number of points awarded for the action.
 * - description: A brief description of the rule.
 *
 * @package App\Models
 */
class GamificationPlan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gamification_plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action',
        'points',
        'description',
    ];

    /**
     * Get the point transactions associated with this plan.
     *
     * @return HasMany
     */
    public function pointTransactions(): HasMany
    {
        return $this->hasMany(PointTransaction::class);
    }
}
