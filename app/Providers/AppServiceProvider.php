<?php

namespace App\Providers;

use App\DataProvider;
use App\Observers\DataProviderObserver;
use App\Observers\TyperObserver;
use App\Typer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(191);
        DataProvider::observe(DataProviderObserver::class);
        Typer::observe(TyperObserver::class);
    }
}
