<?php

namespace App\Repositories;

use App\Repositories\interfaces\CountryRepository;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class RESTCountriesRepository implements CountryRepository
{
    private string $baseUrl;

    private array $countries;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getCountries(
        int|null $startingPage = null,
        int|null $limit = null
    ): array|null {
        $url = $this->url('all', $this->getQueryParams());

        try {
            $this->countries = Http::get($url)->json();
        } catch (RequestException $e) {
            return null;
        }

        $shouldGetPartialList = $startingPage || $limit;
        if ($shouldGetPartialList) {
            return $this->getPartialListOfCountries(
                $this->countries,
                $startingPage ?? 1, $limit ?? 10
            );
        }

        return $this->countries;
    }

    public function getCountry($countryName)
    {
        $path = $this->namePath($countryName);

        $url = $this->url($path, $this->getQueryParams());

        return Http::get($url)->json();
    }

    private function getPartialListOfCountries(
        $countries,
        $startingPage,
        $limit
    ): array {

        $startingPoint = ($startingPage * $limit) - $limit;

        return array_slice($countries, $startingPoint, $limit, true);
    }

    public function getTotalCountriesCount(): int
    {
        return count($this->countries);
    }

    protected function url($path = 'all', $queryParams = ''): string
    {
        $url = $this->baseUrl . '/';

        if ($path) {
            $url .= $path;
        }

        if ($queryParams) {
            $url .= $queryParams;
        }

        return $url;
    }

    private function getQueryParams(): string
    {
        return $this->buildQueryParams([ 'fields' => $this->fields() ]);
    }

    private function buildQueryParams(array $params): string
    {
        $queryParams = [];
        foreach ($params as $key => $value) {
            $queryParams[] = "{$key}={$value}";
        }

        return '?' . implode('&', $queryParams);
    }

    protected function namePath(string $countryName): string
    {
        return $this->buildPath('name', $countryName);
    }

    private function buildPath(string $name, string $value): string
    {
        return "{$name}/{$value}";
    }

    protected function fields(): string
    {
        return 'name,capital,subregion,region,flag,maps,coatOfArms,languages';
    }
}
