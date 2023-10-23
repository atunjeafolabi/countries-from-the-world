<?php

namespace App\Http\Controllers;

use App\Repositories\interfaces\CountryRepository;
use App\Repositories\Sorter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CountriesController extends Controller
{
    private CountryRepository $countryRepository;

    private Sorter $sorter;

    private Request $request;

    public function __construct(
        Sorter $sorter,
        Request $request,
        CountryRepository $countryRepository
    ) {
        $this->countryRepository = $countryRepository;
        $this->sorter            = $sorter;
        $this->request        = $request;
    }

    /**
     * Gets the list of countries
     */
    public function index(): array|LengthAwarePaginator
    {
        $countries = $this->countryRepository->getCountries();

        if ( ! $countries) {
            return ['error' => 'Somehow unable to retrieve countries list'];
        }

        return $this->shouldPaginate()
            ? $this->paginate()
            : ($this->shouldSort() ? $this->sort($countries) : $countries);
    }

    private function shouldSort(): bool
    {
        return $this->request->sortBy || $this->request->sortType;
    }

    /**
     * Gets a single country details by name
     */
    public function show()
    {
        $countryName = $this->request->name;

        // TODO: validate name parameter

        return $this->countryRepository->getCountry($countryName);
    }

    protected function paginate(): LengthAwarePaginator
    {
        $currentPage = $this->request->page ?? 1;
        $limit       = $this->request->limit ?? 12;

        $countries = $this->countryRepository->getCountries($currentPage, $limit);

        return new LengthAwarePaginator(
            $this->shouldSort()
                ? $this->sort($countries)
                : $countries,
            $this->countryRepository->getTotalCountriesCount(),
            $limit,
            $currentPage
        );
    }

    protected function sort(
        array $countries,
        $sortBy = 'region',
        $sortType = 'asc'
    ): array {
        $sortBy   = $this->request->sortBy ?? $sortBy;
        $sortType = $this->request->sortType ?? $sortType;

        return $this->sorter->sort($countries, $sortBy, $sortType);
    }

    protected function shouldPaginate(): bool
    {
        return $this->request->page || $this->request->limit;
    }
}
