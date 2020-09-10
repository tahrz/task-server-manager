<?php

declare(strict_types=1);

namespace App\Parser;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

/**
 * Interface ItemParserInterface
 * @package App\Parser
 */
interface ItemParserInterface
{
    /**
     * @param string $data
     * @return Collection
     */
    public function handle(string $data): Collection;

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function storeImportedFile(UploadedFile $file): string;
}
