<?php

namespace App\Repositories\interfaces;

interface CountryRepository
{
    public function getCountry($countryName);

    public function getCountries(int|null $startingPage, int|null $limit): array | null;

    public function getTotalCountriesCount(): int;

}
