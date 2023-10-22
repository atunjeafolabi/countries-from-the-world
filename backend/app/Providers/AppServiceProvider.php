<?php

namespace App\Providers;

use App\Services\interfaces\CountryService;
use App\Services\RESTCountriesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(CountryService::class, function () {
            return new RESTCountriesService();
        });
    }
}
