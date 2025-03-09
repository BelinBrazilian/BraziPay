<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;
use App\Models\Customer;
use App\Models\GamificationPlan;
use App\Models\ClearsaleOrder;
use App\Models\ClearsaleAddress;
use App\Models\ClearsaleCustomField;
use App\Models\ClearsaleItem;
use App\Models\ClearsaleOrderStatus;
use App\Models\ClearsalePayment;
use App\Models\PagarmeCard;
use App\Models\PagarmeCharge;
use App\Models\PagarmeWebhookLog;
use App\Models\PointTransaction;

/**
 * Class TenantDataSeeder.
 *
 * This seeder generates a random number (between 100 and 200) of records for each model
 * in the tenant database, in an order that respects the dependencies.
 *
 * Additionally, it creates a pool of customers that are used for dependent records (e.g., PagarmeCard).
 *
 * Run this seeder in the tenant context using the tenancy package's run() method.
 *
 * @package Database\Seeders
 */
class TenantDataSeeder extends Seeder
{
    /**
     * Run the tenant data seeder.
     *
     * @return void
     */
    public function run(): void
    {
        // // Generate a random count between 100 and 200 for most records.
        // $count = rand(100, 200);

        // // 1. Create independent data.
        // Badge::factory()->count($count)->create();
        // GamificationPlan::factory()->count($count)->create();

        // // 2. Create a pool of customers, needed for models that reference a customer.
        // $customers = Customer::factory()->count(rand(50, 100))->create();

        // // 3. Create ClearSale orders (parent record).
        // ClearsaleOrder::factory()->count($count)->create();

        // // 4. Create dependent ClearSale records (addresses, custom fields, items, order status, payments).
        // ClearsaleAddress::factory()->count($count)->create();
        // ClearsaleCustomField::factory()->count($count)->create();
        // ClearsaleItem::factory()->count($count)->create();
        // ClearsaleOrderStatus::factory()->count($count)->create();
        // ClearsalePayment::factory()->count($count)->create();

        // // 5. Create Pagarme cards and assign a random customer from the pool.
        // PagarmeCard::factory()->count($count)->make()->each(function ($card) use ($customers) {
        //     $card->customer_id = $customers->random()->id;
        //     $card->save();
        // });

        // // 6. Create Pagarme charges.
        // PagarmeCharge::factory()->count($count)->create();

        // // 7. Create Pagarme webhook logs.
        // PagarmeWebhookLog::factory()->count($count)->create();

        // // 8. Create point transactions (which depend on GamificationPlan, and, se necessário, a relação com User/Customer).
        // PointTransaction::factory()->count($count)->create();
    }
}
