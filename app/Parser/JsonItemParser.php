<?php

declare(strict_types=1);

namespace App\Parser;

use App\Model\ServerItemFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Class JsonItemParser
 * @package App\Parser
 */
class JsonItemParser implements ItemParserInterface
{
    /**
     * @param string $data
     * @return Collection
     */
    public function handle(string $data): Collection
    {
        $itemsArray = \json_decode($data, true);
        $collectionFromData = new Collection();
        $items = isset($itemsArray['data']) ? $itemsArray['data'] : [];
        foreach ($items as $item) {
            if (isset($item['provider']) === true &&
                isset($item['brand_label']) === true &&
                isset($item['location']) === true &&
                isset($item['cpu']) === true &&
                isset($item['drive_label']) === true &&
                isset($item['price']) === true) {
                $collectionFromData->add((new ServerItemFactory())($item));
            } else {
                Log::warning('[parsing problem]: ', $item);
            }
        }

        return $collectionFromData;
    }
}
