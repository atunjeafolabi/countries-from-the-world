<?php

namespace App\Repositories\interfaces;

interface CountryRepository
{
    public function getCountry($countryName);

    public function getCountries(): array | null;

    public function getPartialListOfCountries(): array;

    public function getTotalCountriesCount(): int;

}
