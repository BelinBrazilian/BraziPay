<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Affiliates,
    Apps\PermissionManagementController,
    Apps\RoleManagementController,
    Apps\UserManagementController,
    Auth\SocialiteController,
    Bills,
    Charges,
    Customers,
    DashboardController,
    Discounts,
    ExportBatches,
    ImportBatches,
    Invoices,
    Issues,
    Merchants,
    MerchantUsers,
    Messages,
    Movements,
    Notifications,
    Partners,
    PaymentMethods,
    PaymentProfile,
    Periods,
    Plans,
    Products,
    Roles,
    Subscription,
    Transactions,
    Usages,
    Users
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rotas principais para a aplicação. Essas rotas são carregadas pelo
| RouteServiceProvider dentro de um grupo que contém o middleware "web".
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::prefix('user-management')->name('user-management.')->group(function () {
        Route::resource('users', UserManagementController::class)->except(['edit', 'create']);
        Route::resource('roles', RoleManagementController::class)->except(['edit', 'create']);
        Route::resource('permissions', PermissionManagementController::class)->except(['edit', 'create']);
    });

    // Customers
    Route::resource('customers', Customers::class)->except(['create', 'edit']);
    Route::post('customers/{id}/unarchive', [Customers::class, 'unarchive'])->name('customers.unarchive');

    // Plans
    Route::resource('plans', Plans::class)->except(['create', 'edit']);
    Route::get('plans/{id}/plan_items', [Plans::class, 'planItems'])->name('plans.plan_items');

    // Products (manter comentado como no original)
    // Route::resource('products', Products::class)->except(['create', 'edit']);

    // Payment Methods
    Route::resource('payment_methods', PaymentMethods::class)->only(['index', 'show']);

    // Discounts
    Route::resource('discounts', Discounts::class)->only(['show', 'store', 'destroy']);

    // Subscriptions
    Route::resource('subscriptions', Subscription::class)->except(['create', 'edit']);
    Route::post('subscriptions/{id}/reactivate', [Subscription::class, 'reactivate'])->name('subscriptions.reactivate');
    Route::post('subscriptions/{id}/renew', [Subscription::class, 'renew'])->name('subscriptions.renew');
    Route::get('subscriptions/{id}/product_items', [Subscription::class, 'productItems'])->name('subscriptions.product_items');

    // Periods
    Route::resource('periods', Periods::class)->only(['index', 'show', 'update']);
    Route::post('periods/{id}/bill', [Periods::class, 'bill'])->name('periods.bill');
    Route::get('periods/{id}/usages', [Periods::class, 'usages'])->name('periods.usages');

    // Bills
    Route::resource('bills', Bills::class)->except(['create', 'edit']);
    Route::post('bills/{id}/invoice', [Bills::class, 'invoice'])->name('bills.invoice');
    Route::post('bills/{id}/charge', [Bills::class, 'charge'])->name('bills.charge');
    Route::post('bills/{id}/approve', [Bills::class, 'approve'])->name('bills.approve');
    Route::get('bills/{id}/bill_items', [Bills::class, 'billItems'])->name('bills.billItems');

    // Charges
    Route::resource('charges', Charges::class)->except(['create', 'edit', 'store']);
    Route::post('charges/{id}/capture', [Charges::class, 'capture'])->name('charges.capture');
    Route::post('charges/{id}/fraud_review', [Charges::class, 'fraudReview'])->name('charges.fraud_review');
    Route::post('charges/{id}/refund', [Charges::class, 'refund'])->name('charges.refund');
    Route::post('charges/{id}/charge', [Charges::class, 'charge'])->name('charges.charge');
    Route::post('charges/{id}/reissue', [Charges::class, 'reissue'])->name('charges.reissue');

    // Transactions
    Route::resource('transactions', Transactions::class)->except(['create', 'edit']);
    Route::get('transactions/recoveries', [Transactions::class, 'recoveries'])->name('transactions.recoveries');

    // Payment Profiles
    Route::resource('payment_profiles', PaymentProfile::class)->except(['create', 'edit']);
    Route::post('payment_profiles/{id}/verify', [PaymentProfile::class, 'verify'])->name('payment_profiles.verify');

    // Usages
    Route::resource('usages', Usages::class)->only(['store', 'destroy']);

    // Invoices
    Route::resource('invoices', Invoices::class)->except(['create', 'edit']);
    Route::post('invoices/{id}/retry', [Invoices::class, 'retry'])->name('invoices.retry');

    // Movements
    Route::resource('movements', Movements::class)->only(['store', 'destroy']);

    // Messages
    Route::resource('messages', Messages::class)->only(['index', 'show', 'store']);

    // Export Batches
    Route::resource('export_batches', ExportBatches::class)->except(['edit', 'update', 'destroy']);
    Route::post('export_batches/{id}/approve', [ExportBatches::class, 'approve'])->name('export_batches.approve');

    // Import Batches
    Route::resource('import_batches', ImportBatches::class)->except(['edit', 'update', 'destroy']);

    // Issues
    Route::resource('issues', Issues::class)->only(['index', 'show', 'update']);

    // Notifications
    Route::resource('notifications', Notifications::class)->except(['create', 'edit']);
    Route::get('notifications/{id}/notification_items', [Notifications::class, 'notificationItemIndex'])->name('notifications.notification_item_index');
    Route::post('notifications/{id}/notification_items', [Notifications::class, 'notificationItemStore'])->name('notifications.notification_item_store');
    Route::delete('notifications/{id}/notification_items/{notification_item_id}', [Notifications::class, 'notificationItemDestroy'])->name('notifications.notification_item_destroy');

    // Merchants
    Route::resource('merchants', Merchants::class)->only(['index', 'show', 'update']);
    Route::get('merchants/current', [Merchants::class, 'current'])->name('merchants.current');

    // Merchant Users
    Route::resource('merchant_users', MerchantUsers::class)->except(['create', 'edit']);
    Route::post('merchant_users/{id}/reactivate', [MerchantUsers::class, 'reactivate'])->name('merchant_users.reactivate');

    // Roles
    Route::resource('roles', Roles::class)->only(['index']);

    // Affiliates
    Route::resource('affiliates', Affiliates::class)->except(['create', 'edit']);
    Route::put('affiliates/{id}/verify', [Affiliates::class, 'verify'])->name('affiliates.verify');

    // Partner
    Route::resource('partner', Partners::class)->only(['index', 'store']);
});

// Rotas públicas
Route::get('/customers', [Customers::class, 'index'])->name('customers.index');
//Route::get('/', fn() => 'OK');
Route::get('/', fn() => redirect()->route(auth()->check() ? 'home': 'login'));
Route::get('/error', fn() => abort(500));
Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

// Rotas de autenticação
require __DIR__ . '/auth.php';
