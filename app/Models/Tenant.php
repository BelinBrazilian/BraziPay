<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

/**
 * Class Tenant.
 *
 * This model represents a tenant in the application.
 * It extends the BaseTenant provided by the tenancy package and
 * implements the TenantWithDatabase contract.
 *
 * Custom columns are defined to expose essential tenant attributes
 * (e.g., name, plan, currency, filament_theme, pagarme_api_key, clearsale_api_key)
 * directly in the database instead of storing them only in a JSON field.
 *
 * @package App\Models
 */
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasFactory, HasDatabase, HasDomains;

    // Adicione campos específicos do Tenant aqui
    protected $fillable = [
        'id',
        'name',
        'domain',
        'data',
    ];

    /**
     * Get the list of custom columns that should be stored as individual columns.
     *
     * @return array
     */
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'plan',
            'currency',
            'filament_theme',
        ];
    }
}
