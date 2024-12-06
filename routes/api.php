<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use App\Http\Controllers\API\Affiliates;
use App\Http\Controllers\API\Bills;
use App\Http\Controllers\API\Charges;
use App\Http\Controllers\API\Customers;
use App\Http\Controllers\API\Discounts;
use App\Http\Controllers\API\ExportBatches;
use App\Http\Controllers\API\ImportBatches;
use App\Http\Controllers\API\Invoices;
use App\Http\Controllers\API\Issues;
use App\Http\Controllers\API\Merchants;
use App\Http\Controllers\API\MerchantUsers;
use App\Http\Controllers\API\Messages;
use App\Http\Controllers\API\Movements;
use App\Http\Controllers\API\Notifications;
use App\Http\Controllers\API\Partners;
use App\Http\Controllers\API\PaymentMethods;
use App\Http\Controllers\API\PaymentProfile;
use App\Http\Controllers\API\Periods;
use App\Http\Controllers\API\Plans;
use App\Http\Controllers\API\Roles;
use App\Http\Controllers\Products;
use App\Http\Controllers\API\Subscription;
use App\Http\Controllers\API\Transactions;
use App\Http\Controllers\API\Usages;
use App\Http\Controllers\API\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());

// Prefixo da API v1
Route::prefix('v1')->group(function () {
    // Users API
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [SampleUserApi::class, 'datatableList'])->name('index');
        Route::post('/list', [SampleUserApi::class, 'datatableList'])->name('list');
        Route::post('/', [SampleUserApi::class, 'create'])->name('create');
        Route::get('/{id}', [SampleUserApi::class, 'get'])->name('show');
        Route::put('/{id}', [SampleUserApi::class, 'update'])->name('update');
        Route::delete('/{id}', [SampleUserApi::class, 'delete'])->name('destroy');
    });

    // Roles API
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [SampleRoleApi::class, 'datatableList'])->name('index');
        Route::post('/list', [SampleRoleApi::class, 'datatableList'])->name('list');
        Route::post('/', [SampleRoleApi::class, 'create'])->name('create');
        Route::get('/{id}', [SampleRoleApi::class, 'get'])->name('show');
        Route::put('/{id}', [SampleRoleApi::class, 'update'])->name('update');
        Route::delete('/{id}', [SampleRoleApi::class, 'delete'])->name('destroy');
        Route::post('/{id}/users', [SampleRoleApi::class, 'usersDatatableList'])->name('users.list');
        Route::delete('/{id}/users/{user_id}', [SampleRoleApi::class, 'deleteUser'])->name('users.destroy');
    });

    // Permissions API
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [SamplePermissionApi::class, 'datatableList'])->name('index');
        Route::post('/list', [SamplePermissionApi::class, 'datatableList'])->name('list');
        Route::post('/', [SamplePermissionApi::class, 'create'])->name('create');
        Route::get('/{id}', [SamplePermissionApi::class, 'get'])->name('show');
        Route::put('/{id}', [SamplePermissionApi::class, 'update'])->name('update');
        Route::delete('/{id}', [SamplePermissionApi::class, 'delete'])->name('destroy');
    });

    // Customers, Plans, Products, Discounts, Affiliates
    Route::middleware('auth:sanctum')->group(function () {
        // Customers
        Route::resource('customers', Customers::class)->except(['create', 'edit']);
        Route::post('customers/{id}/unarchive', [Customers::class, 'unarchive'])->name('customers.unarchive')->name('customers.unarchive');

        // Plans
        Route::get('/plans', [Plans::class, 'index'])->name('plans.index');
        Route::get('/plans/{id}', [Plans::class, 'show'])->name('plans.show');
        Route::post('/plans', [Plans::class, 'store'])->name('plans.store');
        Route::put('/plans/{id}', [Plans::class, 'update'])->name('plans.update');
        Route::get('/plans/{id}/plan_items', [Plans::class, 'planItems'])->name('plans.plan_items');

        // Products
        // Route::get('/products', [Products::class, 'index'])->name('products.index');
        // Route::get('/products/{id}', [Products::class, 'show'])->name('products.show');
        // Route::post('/products', [Products::class, 'store'])->name('products.store');
        // Route::put('/products/{id}', [Products::class, 'update'])->name('products.update');

        // Payment Methods
        Route::get('/payment_methods', [PaymentMethods::class, 'index'])->name('payment_methods.index');
        Route::get('/payment_methods/{id}', [PaymentMethods::class, 'show'])->name('payment_methods.show');

        // Discounts
        Route::get('/discounts/{id}', [Discounts::class, 'show'])->name('discounts.show');
        Route::post('/discounts', [Discounts::class, 'store'])->name('discounts.store');
        Route::delete('/discounts/{id}', [Discounts::class, 'destroy'])->name('discounts.destroy');

        // Subscriptions
        Route::get('/subscriptions', [Subscription::class, 'index'])->name('subscriptions.index');
        Route::get('/subscriptions/{id}', [Subscription::class, 'show'])->name('subscriptions.show');
        Route::post('/subscriptions', [Subscription::class, 'store'])->name('subscriptions.store');
        Route::put('/subscriptions/{id}', [Subscription::class, 'update'])->name('subscriptions.update');
        Route::delete('/subscriptions/{id}', [Subscription::class, 'destroy'])->name('subscriptions.destroy');
        Route::post('/subscriptions/{id}/reactivate', [Subscription::class, 'reactivate'])->name('subscriptions.reactivate');
        Route::post('/subscriptions/{id}/renew', [Subscription::class, 'renew'])->name('subscriptions.renew');
        Route::get('/subscriptions/{id}/product_items', [Subscription::class, 'productItems'])->name('subscriptions.product_items');

        // Product Items
        // Route::get('/product_items/{id}', [ProductItems::class, 'show'])->name('product_items.show');
        // Route::post('/product_items', [ProductItems::class, 'store'])->name('product_items.store');
        // Route::put('/product_items/{id}', [ProductItems::class, 'update'])->name('product_items.update');
        // Route::delete('/product_items/{id}', [ProductItems::class, 'destroy'])->name('product_items.destroy');

        // Periods
        Route::get('/periods', [Periods::class, 'index'])->name('periods.index');
        Route::get('/periods/{id}', [Periods::class, 'show'])->name('periods.show');
        Route::put('/periods/{id}', [Periods::class, 'update'])->name('periods.update');
        Route::post('/periods/{id}/bill', [Periods::class, 'bill'])->name('periods.bill');
        Route::get('/periods/{id}/usages', [Periods::class, 'usages'])->name('periods.usages');

        // Bills
        Route::get('/bills', [Bills::class, 'index'])->name('bills.index');
        Route::get('/bills/{id}', [Bills::class, 'show'])->name('bills.show');
        Route::post('/bills', [Bills::class, 'store'])->name('bills.store');
        Route::put('/bills/{id}', [Bills::class, 'update'])->name('bills.update');
        Route::delete('/bills/{id}', [Bills::class, 'destroy'])->name('bills.destroy');
        Route::post('/bills/{id}/invoice', [Bills::class, 'invoice'])->name('bills.invoice');
        Route::post('/bills/{id}/charge', [Bills::class, 'charge'])->name('bills.charge');
        Route::post('/bills/{id}/approve', [Bills::class, 'approve'])->name('bills.approve');
        Route::get('/bills/{id}/bill_items', [Bills::class, 'billItems'])->name('bills.billItems');

        // Bill Items
        // Route::get('/bill_items/{id}', [BillItems::class, 'show'])->name('bill_items.show');

        // Charges
        Route::get('/charges', [Charges::class, 'index'])->name('charges.index');
        Route::get('/charges/{id}', [Charges::class, 'show'])->name('charges.show');
        Route::put('/charges/{id}', [Charges::class, 'update'])->name('charges.update');
        Route::delete('/charges/{id}', [Charges::class, 'destroy'])->name('charges.destroy');
        Route::post('/charges/{id}/capture', [Charges::class, 'capture'])->name('charges.capture');
        Route::post('/charges/{id}/fraud_review', [Charges::class, 'fraudReview'])->name('charges.fraud_review');
        Route::post('/charges/{id}/refund', [Charges::class, 'refund'])->name('charges.refund');
        Route::post('/charges/{id}/charge', [Charges::class, 'charge'])->name('charges.charge'); // Assuming this is for retrying a charge
        Route::post('/charges/{id}/reissue', [Charges::class, 'reissue'])->name('charges.reissue');

        // Transactions
        Route::get('/transactions', [Transactions::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{id}', [Transactions::class, 'show'])->name('transactions.show');
        Route::post('/transactions', [Transactions::class, 'store'])->name('transactions.store');
        Route::put('/transactions/{id}', [Transactions::class, 'update'])->name('transactions.update');
        Route::get('/transactions/recoveries', [Transactions::class, 'recoveries'])->name('transactions.recoveries');

        // Payment Profiles
        Route::get('/payment_profiles', [PaymentProfile::class, 'index'])->name('payment_profiles.index');
        Route::get('/payment_profiles/{id}', [PaymentProfile::class, 'show'])->name('payment_profiles.show');
        Route::post('/payment_profiles', [PaymentProfile::class, 'store'])->name('payment_profiles.store');
        Route::put('/payment_profiles/{id}', [PaymentProfile::class, 'update'])->name('payment_profiles.update');
        Route::delete('/payment_profiles/{id}', [PaymentProfile::class, 'destroy'])->name('payment_profiles.destroy');
        Route::post('/payment_profiles/{id}/verify', [PaymentProfile::class, 'verify'])->name('payment_profiles.verify');

        // Usages
        Route::post('/usages', [Usages::class, 'store'])->name('usages.store');
        Route::delete('/usages/{id}', [Usages::class, 'destroy'])->name('usages.destroy');

        // Invoices
        Route::get('/invoices', [Invoices::class, 'index'])->name('invoices.index');
        Route::get('/invoices/{id}', [Invoices::class, 'show'])->name('invoices.show');
        Route::post('/invoices', [Invoices::class, 'store'])->name('invoices.store');
        Route::put('/invoices/{id}', [Invoices::class, 'update'])->name('invoices.update');
        Route::delete('/invoices/{id}', [Invoices::class, 'destroy'])->name('invoices.destroy');
        Route::post('/invoices/{id}/retry', [Invoices::class, 'retry'])->name('invoices.retry');

        // Movements
        Route::post('/movements', [Movements::class, 'store'])->name('movements.store');
        Route::delete('/movements/{id}', [Movements::class, 'destroy'])->name('movements.destroy');

        // Messages
        Route::get('/messages', [Messages::class, 'index'])->name('messages.index');
        Route::get('/messages/{id}', [Messages::class, 'show'])->name('messages.show');
        Route::post('/messages', [Messages::class, 'store'])->name('messages.store');

        // Export Batches
        Route::get('/export_batches', [ExportBatches::class, 'index'])->name('export_batches.index');
        Route::get('/export_batches/{id}', [ExportBatches::class, 'show'])->name('export_batches.show');
        Route::post('/export_batches', [ExportBatches::class, 'store'])->name('export_batches.store');
        Route::post('/export_batches/{id}/approve', [ExportBatches::class, 'approve'])->name('export_batches.approve');

        // Import Batches
        Route::get('/import_batches', [ImportBatches::class, 'index'])->name('import_batches.index');
        Route::get('/import_batches/{id}', [ImportBatches::class, 'show'])->name('import_batches.show');
        Route::post('/import_batches', [ImportBatches::class, 'store'])->name('import_batches.store');

        // Issues
        Route::get('/issues', [Issues::class, 'index'])->name('issues.index');
        Route::get('/issues/{id}', [Issues::class, 'show'])->name('issues.show');
        Route::put('/issues/{id}', [Issues::class, 'update'])->name('issues.update');

        // Notifications
        Route::get('/notifications', [Notifications::class, 'index'])->name('notifications.index');
        Route::get('/notifications/{id}', [Notifications::class, 'show'])->name('notifications.show');
        Route::post('/notifications', [Notifications::class, 'store'])->name('notifications.store');
        Route::put('/notifications/{id}', [Notifications::class, 'update'])->name('notifications.update');
        Route::delete('/notifications/{id}', [Notifications::class, 'destroy'])->name('notifications.destroy');
        Route::get('/notifications/{id}/notification_items', [Notifications::class, 'notificationItemIndex'])->name('notifications.notification_item_index');
        Route::post('/notifications/{id}/notification_items', [Notifications::class, 'notificationItemStore'])->name('notifications.notification_item_store');
        Route::delete('/notifications/{id}/notification_items/{notification_item_id}', [Notifications::class, 'notificationItemDestroy'])->name('notifications.notification_item_destroy');

        // Merchants
        Route::get('/merchants/{id}', [Merchants::class, 'show'])->name('merchants.show');
        Route::get('/merchants/current', [Merchants::class, 'current'])->name('merchants.current');
        Route::get('/merchants', [Merchants::class, 'index'])->name('merchants.index');
        Route::patch('/merchants/{id}', [Merchants::class, 'update'])->name('merchants.update');

        // Merchant Users
        Route::get('/merchant_users/{id}', [MerchantUsers::class, 'show'])->name('merchant_users.show');
        Route::post('/merchant_users', [MerchantUsers::class, 'store'])->name('merchant_users.store');
        Route::put('/merchant_users/{id}', [MerchantUsers::class, 'update'])->name('merchant_users.update');
        Route::delete('/merchant_users/{id}', [MerchantUsers::class, 'destroy'])->name('merchant_users.destroy');
        Route::post('/merchant_users/{id}/reactivate', [MerchantUsers::class, 'reactivate'])->name('merchant_users.reactivate');
        Route::get('/merchant_users', [MerchantUsers::class, 'index'])->name('merchant_users.index');

        // Roles
        Route::get('/roles', [Roles::class, 'index'])->name('roles.index');

        // User
        Route::get('/users', [Users::class, 'index'])->name('users.index');

        // Affiliates
        Route::resource('affiliates', Affiliates::class)->except(['create', 'edit']);
        Route::put('affiliates/{id}/verify', [Affiliates::class, 'verify'])->name('affiliates.verify');

        // Partner
        Route::get('/partner', [Partners::class, 'index'])->name('partner.index');
        Route::post('/partner', [Partners::class, 'store'])->name('partner.store');
    });
});
