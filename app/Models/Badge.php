<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Badge.
 *
 * This model defines the achievements (badges) that users can earn.
 *
 * Fields:
 * - name: The name of the badge.
 * - slug: A unique slug for the badge.
 * - description: A description of the badge.
 * - criteria: Minimum points required to earn the badge (optional).
 * - image_url: Optional URL for the badge image.
 *
 * @package App\Models
 */
class Badge extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'badges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'criteria',
        'image_url',
    ];

    /**
     * The badges that have been awarded to users.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'badge_user')
                    ->withPivot('awarded_at')
                    ->withTimestamps();
    }
}
