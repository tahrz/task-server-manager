<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorInterface;

/**
 * Class CollectionPaginator
 * @package App\Service
 */
class CollectionPaginator implements PaginatorInterface
{
    /**
     * @param Collection $items
     * @param int $perPage
     * @return LengthAwarePaginatorInterface
     */
    public function make(Collection $items, int $perPage): LengthAwarePaginatorInterface
    {
        $page = Paginator::resolveCurrentPage('page');
        $total = $items->count();

        return new LengthAwarePaginator($items->forPage($page, $perPage), $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }
}
