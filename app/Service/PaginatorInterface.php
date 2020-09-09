<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorInterface;

/**
 * Interface PaginatorInterface
 * @package App\Service
 */
interface PaginatorInterface
{
    /**
     * @param Collection $items
     * @param int $perPage
     * @return LengthAwarePaginatorInterface
     */
    public function make(Collection $items, int $perPage): LengthAwarePaginatorInterface;
}
