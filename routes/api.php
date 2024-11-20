<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use App\Http\Controllers\API\Customers;
use App\Http\Controllers\API\Plans;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::get('/users', function (Request $request) {
        return app(SampleUserApi::class)->datatableList($request);
    });

    Route::post('/users-list', function (Request $request) {
        return app(SampleUserApi::class)->datatableList($request);
    });

    Route::post('/users', function (Request $request) {
        return app(SampleUserApi::class)->create($request);
    });

    Route::get('/users/{id}', function ($id) {
        return app(SampleUserApi::class)->get($id);
    });

    Route::put('/users/{id}', function ($id, Request $request) {
        return app(SampleUserApi::class)->update($id, $request);
    });

    Route::delete('/users/{id}', function ($id) {
        return app(SampleUserApi::class)->delete($id);
    });


    Route::get('/roles', function (Request $request) {
        return app(SampleRoleApi::class)->datatableList($request);
    });

    Route::post('/roles-list', function (Request $request) {
        return app(SampleRoleApi::class)->datatableList($request);
    });

    Route::post('/roles', function (Request $request) {
        return app(SampleRoleApi::class)->create($request);
    });

    Route::get('/roles/{id}', function ($id) {
        return app(SampleRoleApi::class)->get($id);
    });

    Route::put('/roles/{id}', function ($id, Request $request) {
        return app(SampleRoleApi::class)->update($id, $request);
    });

    Route::delete('/roles/{id}', function ($id) {
        return app(SampleRoleApi::class)->delete($id);
    });

    Route::post('/roles/{id}/users', function (Request $request, $id) {
        $request->merge(['id' => $id]);
        return app(SampleRoleApi::class)->usersDatatableList($request);
    });

    Route::delete('/roles/{id}/users/{user_id}', function ($id, $user_id) {
        return app(SampleRoleApi::class)->deleteUser($id, $user_id);
    });



    Route::get('/permissions', function (Request $request) {
        return app(SamplePermissionApi::class)->datatableList($request);
    });

    Route::post('/permissions-list', function (Request $request) {
        return app(SamplePermissionApi::class)->datatableList($request);
    });

    Route::post('/permissions', function (Request $request) {
        return app(SamplePermissionApi::class)->create($request);
    });

    Route::get('/permissions/{id}', function ($id) {
        return app(SamplePermissionApi::class)->get($id);
    });

    Route::put('/permissions/{id}', function ($id, Request $request) {
        return app(SamplePermissionApi::class)->update($id, $request);
    });

    Route::delete('/permissions/{id}', function ($id) {
        return app(SamplePermissionApi::class)->delete($id);
    });
});


Route::middleware('auth:sanctum')->group(function() {
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
    
