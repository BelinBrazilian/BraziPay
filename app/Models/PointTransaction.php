<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PointTransaction.
 *
 * This model records each point transaction for a user.
 *
 * Fields:
 * - user_id: Reference to the user receiving the points.
 * - gamification_plan_id: (Optional) Reference to the corresponding gamification plan.
 * - points: The number of points awarded (or deducted).
 * - description: Description of the transaction.
 *
 * @package App\Models
 */
class PointTransaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'point_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'gamification_plan_id',
        'points',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'points' => 'integer',
    ];

    /**
     * Get the user associated with the point transaction.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the gamification plan associated with the point transaction.
     *
     * @return BelongsTo
     */
    public function gamificationPlan(): BelongsTo
    {
        return $this->belongsTo(GamificationPlan::class);
    }
}
