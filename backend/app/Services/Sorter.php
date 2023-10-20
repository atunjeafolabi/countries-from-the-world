<?php

namespace App\Services;

class Sorter
{
    public function sort($contents, $sortBy, $sortType)
    {
        usort($contents, function ($a, $b) use ($sortBy, $sortType) {
            return strtolower($sortType) === 'desc' ? strcmp($b[$sortBy], $a[$sortBy]) : strcmp($a[$sortBy], $b[$sortBy]);
        });

        return $contents;
    }
}
