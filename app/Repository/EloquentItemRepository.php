<?php

declare(strict_types=1);

namespace App\Repository;

use Exception;
use App\Model\ServerItem;
use Illuminate\Support\Collection;

/**
 * Class EloquentItemRepository
 * @package App\Repository
 */
class EloquentItemRepository implements ItemRepositoryInterface
{
    /**
     * @param ServerItem $item
     */
    public function store(ServerItem $item): void
    {
        $item->save();
    }

    /**
     * @param ServerItem $item
     * @param array $data
     */
    public function update(ServerItem $item, array $data): void
    {
        $item->update($data);
    }

    /**
     * @param ServerItem $item
     * @throws Exception
     */
    public function delete(ServerItem $item): void
    {
        $item->delete();
    }

    /**
     * @param int $size
     * @param Collection $items
     */
    public function chunkCreate(int $size, Collection $items): void
    {
        ServerItem::insert($items->toArray());
    }

    /**
     * @param int $size
     * @param Collection $items
     */
    public function chunkUpdate(int $size, Collection $items): void
    {
        $items->chunk($size)->each(function ($chunk) {
            $chunk->each(fn($item) => $item->update());
        });
    }

    /**
     * @param int $size
     * @param Collection $items
     */
    public function chunkDelete(int $size, Collection $items): void
    {
        $items->chunk($size)->each(function ($chunk) {
            $chunk->each(fn($item) => $item->delete());
        });
    }
}
