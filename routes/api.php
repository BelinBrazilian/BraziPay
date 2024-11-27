<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use App\Http\Controllers\API\Affiliates;
use App\Http\Controllers\API\Customers;
use App\Http\Controllers\API\Discounts;
use App\Http\Controllers\API\Plans;
use App\Http\Controllers\API\Roles;
use App\Http\Controllers\Products;
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

Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());

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

        // Roles (Caso tenha lógica adicional)
        Route::get('/roles', [Roles::class, 'index'])->name('roles.index');
    });
});
