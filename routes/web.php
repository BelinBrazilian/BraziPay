<?php

use App\Http\Controllers\Affiliates;
use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Customers;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Discounts;
use App\Http\Controllers\Plans;
use App\Http\Controllers\Products;
use App\Http\Controllers\Roles;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::prefix('user-management')->name('user-management.')->group(function () {
        Route::resource('users', UserManagementController::class);
        Route::resource('roles', RoleManagementController::class);
        Route::resource('permissions', PermissionManagementController::class);
    });

    // Customers
    Route::resource('customers', Customers::class)->except(['create', 'edit']);
    Route::post('customers/{id}/unarchive', [Customers::class, 'unarchive'])->name('customers.unarchive');

    // Plans
    Route::resource('plans', Plans::class)->except(['create', 'edit']);
    Route::get('plans/{id}/plan_items', [Plans::class, 'plan_items'])->name('plans.plan_items');

    // Products
    Route::resource('products', Products::class)->except(['create', 'edit']);

    // Discounts
    Route::resource('discounts', Discounts::class)->only(['index', 'show', 'store', 'destroy']);

    // Affiliates
    Route::resource('affiliates', Affiliates::class)->except(['create', 'edit']);
    Route::put('affiliates/{id}/verify', [Affiliates::class, 'verify'])->name('affiliates.verify');

    // Roles
    Route::get('/roles', [Roles::class, 'index'])->name('roles.index');
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
