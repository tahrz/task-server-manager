<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\ServerItem;
use Illuminate\Support\Collection;

/**
 * Interface ItemRepositoryInterface
 * @package App\Repository
 */
interface ItemRepositoryInterface
{
    /**
     * @param ServerItem $item
     */
    public function store(ServerItem $item): void;

    /**
     * @param ServerItem $item
     * @param array $data
     */
    public function update(ServerItem $item, array $data): void;

    /**
     * @param ServerItem $item
     */
    public function delete(ServerItem $item): void;

    /**
     * @param int $size
     * @param Collection<ServerItem> $items
     */
    public function chunkCreate(int $size, Collection $items): void;

    /**
     * @param int $size
     * @param Collection<ServerItem> $items
     */
    public function chunkUpdate(int $size, Collection $items): void;

    /**
     * @param int $size
     * @param Collection<ServerItem> $items
     */
    public function chunkDelete(int $size, Collection $items): void;
}
