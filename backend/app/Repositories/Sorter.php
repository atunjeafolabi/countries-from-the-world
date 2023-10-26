<?php

namespace App\Repositories;

class Sorter
{
    public function sort(
        array $contents,
        string $sortBy,
        string $sortType
    ): array {
        usort($contents, function ($a, $b) use ($sortBy, $sortType) {
            return strtolower($sortType) === 'desc' ? strcmp($b[$sortBy],
                $a[$sortBy]) : strcmp($a[$sortBy], $b[$sortBy]);
        });

        return $contents;
    }
}
