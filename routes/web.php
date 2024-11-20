<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Customers;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Plans;
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

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

    // Customers
    Route::get('/customers', [Customers::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}', [Customers::class, 'show'])->name('customers.show');
    Route::post('/customers', [Customers::class, 'store'])->name('customers.store');
    Route::put('/customers/{id}', [Customers::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [Customers::class, 'destroy'])->name('customers.destroy');
    Route::post('/customers/{id}/unarchive', [Customers::class, 'unarchive']);

    // Plans
    Route::get('/plans', [Plans::class, 'index'])->name('plans.index');
    Route::get('/plans/{id}', [Plans::class, 'show'])->name('plans.show');
    Route::post('/plans', [Plans::class, 'store'])->name('plans.store');
    Route::put('/plans/{id}', [Plans::class, 'update'])->name('plans.update');
    Route::get('/plans/{id}/plan_items', [Plans::class, 'plan_items'])->name('plans.plan_items');
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
