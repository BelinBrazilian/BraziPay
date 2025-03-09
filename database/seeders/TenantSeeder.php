<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;

/**
 * Class TenantSeeder.
 *
 * This seeder creates sample tenants using the TenantFactory.
 * For each tenant, a domain is automatically assigned based on its generated id,
 * and then tenant-specific data is seeded using TenantDataSeeder.
 *
 * Run this seeder using:
 *   php artisan db:seed --class="Database\\Seeders\\TenantSeeder"
 *
 * @package Database\Seeders
 */
class TenantSeeder extends Seeder
{
    /**
     * Run the tenant seeder.
     *
     * @return void
     */
    public function run(): void
    {
//         // Create 20 tenants using the factory.
//         Tenant::factory()->count(20)->create()->each(function ($tenant) {
//             // Assign a domain based on the tenant's id.
//             $tenant->domains()->create([
//                                            'domain' => $tenant->id . '.localhost',
//                                        ]);

//             // Run tenant-specific seeders within the tenant's database context.
// //            $tenant->run(function () {
// //                // Instantiate and run the TenantDataSeeder.
// //                new TenantDataSeeder()->run();
// //            });
        // });
    }
}
