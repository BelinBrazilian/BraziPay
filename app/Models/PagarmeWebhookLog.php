<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PagarmeWebhookLog.
 *
 * This model stores the webhook payloads received from the Pagar.me API for auditing and debugging.
 *
 * Fields:
 * - payload: JSON data of the webhook.
 * - received_at: Timestamp when the webhook was received.
 *
 * @package App\Models
 */
class PagarmeWebhookLog extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pagarme_webhook_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payload',
        'received_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'payload' => 'array',
        'received_at' => 'datetime',
    ];
}
