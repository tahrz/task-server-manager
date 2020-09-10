<?php

declare(strict_types=1);

namespace App\Parser;

use DateTime;
use App\Model\ServerItemFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class JsonItemParser
 * @package App\Parser
 */
class JsonItemParser implements ItemParserInterface
{
    private const HISTORY_LIMIT = 5;
    private const IMPORT_FOLDER = '/import/';

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
            }
        }

        return $collectionFromData;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function storeImportedFile(UploadedFile $file): string
    {
        $files = Storage::allFiles(self::IMPORT_FOLDER);

        if (\count($files) >= self::HISTORY_LIMIT) {
            Storage::delete($files[0]);
        }

        $generatedFilename = (new DateTime())->format('Y-M-d H:i:s') . '.json';
        $file->storeAs(self::IMPORT_FOLDER, $generatedFilename);

        return '/import/' . $generatedFilename;
    }
}
