<?php

namespace App\Providers;

use App\Core\KTBootstrap;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Update defaultStringLength
        Builder::defaultStringLength(191);

        KTBootstrap::init();

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/starterkit/metronic/laravel/livewire/update', $handle);
        });
    }
}
