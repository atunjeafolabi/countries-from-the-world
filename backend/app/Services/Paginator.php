<?php

namespace App\Services;

class Paginator
{
    public function paginate(array $array, $page = 1, $perPage = 5): array
    {
        $total = count($array);
        $current_page = $page ?? 1;

        $starting_point = ($current_page * $perPage) - $perPage;

        $array = array_slice($array, $starting_point, $perPage, true);

//        $array = new LengthAwarePaginator($array, $total, $perPage, $current_page);

        return [
            'content' => $array,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $current_page
        ];
    }
}
