<?php

namespace App\Repositories;

use App\Repositories\interfaces\CountryRepository;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class RESTCountriesRepository implements CountryRepository
{
    private string $countriesAPI;

    private array $countries;

    public function __construct()
    {
        $this->countriesAPI = config('app.countriesUrl');
    }

    public function getCountries(): array | null
    {
        $fieldsToReturn = 'name,capital,subregion,region,flag';
        $url = "$this->countriesAPI/all?fields=$fieldsToReturn";

        try {
            $this->countries = Http::get($url)->json();
        }catch (RequestException $e) {
            return null;
        }

        return $this->countries;
    }

    public function getPartialListOfCountries($startingPage = 1, $limit = 5): array
    {
        $this->countries ?? $this->getCountries();

        $startingPoint = ($startingPage * $limit) - $limit;

        return array_slice($this->countries, $startingPoint, $limit, true);
    }

    public function getTotalCountriesCount(): int
    {
        return count($this->countries);
    }

    public function getCountry($countryName)
    {
        $url = "$this->countriesAPI/name/{$countryName}";

        return Http::get($url)->json();
    }
}
