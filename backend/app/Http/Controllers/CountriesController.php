<?php

namespace App\Http\Controllers;

use App\Services\CountriesService;
use App\Services\Paginator;
use App\Services\Sorter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CountriesController extends Controller
{
    private CountriesService $countriesService;

    /**
     * Gets paginated list of countries
     */
    public function __construct(CountriesService $countriesService)
    {
        $this->countriesService = $countriesService;
    }

    public function paginate(
        Request $request,
        Paginator $paginator,
        Sorter $sorter
    ) {
        $page    = $request->page;
        $perPage = $request->limit;

        $contents = $this->countriesService->fetchCountries();

        $contents
            = $paginator->paginate($contents, $page, $perPage);

        if ($request->sortBy != null && $request->sortType != null) {
            $sortedContents = $sorter->sort(
                $contents['content'],
                $request->sortBy,
                $request->sortType
            );
        }

        return response()->json(
            new LengthAwarePaginator(
                $sortedContents ?? $contents['content'],
                $contents['total'],
                $contents['perPage'],
                $contents['currentPage']
            )
        );
    }

    /**
     * Gets a single country by name with details
     */
    public function show(Request $request)
    {
        $countryName = $request->name;

        return response()->json($this->countriesService->getCountry($countryName));
    }
}
