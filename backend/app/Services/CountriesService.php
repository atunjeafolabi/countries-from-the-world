<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class CountriesService
{
    private string $countriesAPI;

    public function __construct()
    {
        $this->countriesAPI = config('app.countriesUrl');
    }

    public function fetchCountries()
    {
        $fieldsToReturn = 'name,capital,subregion,region,flag';
        $url = "$this->countriesAPI/all?fields=$fieldsToReturn";

        try {
            $response = Http::get($url)->json();
        }catch (ConnectionException $e) {
            return "Unable to connect to API";
        }

        return $response;
    }

    public function getCountry($countryName)
    {
        $url = "$this->countriesAPI/name/{$countryName}";

        return Http::get($url)->json();
    }
}
