<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | External API to fetch Countries
    |--------------------------------------------------------------------------
    |
    | This is a URL to an external API
    |
    */

    'countriesUrl' => env('COUNTRIES_API_URL', 'Laravel'),
];
