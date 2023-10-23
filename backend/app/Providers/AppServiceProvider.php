<?php

namespace App\Providers;

use App\Repositories\interfaces\CountryRepository;
use App\Repositories\RESTCountriesRepository;
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
        $this->app->singleton(CountryRepository::class, function () {
            return new RESTCountriesRepository(config('app.countriesUrl'));
        });
    }
}
