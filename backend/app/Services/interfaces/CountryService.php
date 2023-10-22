<?php

namespace App\Services\interfaces;

interface CountryService
{
    public function getCountry($countryName);

    public function getCountries(): array | null;

    public function limitResults(): array;

    public function getTotalCountriesCount(): int;

}
