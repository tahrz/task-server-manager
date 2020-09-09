<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use DateTime;
use App\Model\ServerItem;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Service\PaginatorInterface;
use App\Parser\ItemParserInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use App\Repository\ItemRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class ImportController
 * @package App\Http\Controllers
 */
class ImportController extends Controller
{
    private const HISTORY_LIMIT = 5;
    private const IMPORT_FOLDER = '/import/';

    /**
     * @var ItemParserInterface
     */
    private ItemParserInterface $parser;

    /**
     * @var ItemRepositoryInterface
     */
    private ItemRepositoryInterface $repository;

    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    /**
     * @param ItemParserInterface $parser
     * @param ItemRepositoryInterface $itemRepository
     * @param PaginatorInterface $paginator
     */
    public function __construct(
        ItemParserInterface $parser,
        ItemRepositoryInterface $itemRepository,
        PaginatorInterface $paginator
    )
    {
        $this->parser = $parser;
        $this->repository = $itemRepository;
        $this->paginator = $paginator;
    }

    /**
     * @param int|null $key
     * @return View
     */
    public function history(?int $key = null): View
    {
        $filesList = \array_reverse(Storage::allFiles('import'));
        $selectedKey = $key ?? \array_key_first($filesList);
        $parsed = empty($filesList) ? new Collection() : $this->parser->handle(Storage::get($filesList[$selectedKey]));

        return view('server-history-list', [
            'navList' => $filesList,
            'selectedData' => $this->paginator->make($parsed, 20),
            'selectedKey' => $selectedKey
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function import(): View
    {
        return view('server-import');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function importAction(Request $request): RedirectResponse
    {
        $filename = $request->file('dump');
        [$create, $update, $delete] = $this->prepareActionCollections($this->storeImportedFile($filename));

        DB::transaction(function () use ($create, $update, $delete) {
            $this->repository->chunkCreate(100, $create);
            $this->repository->chunkUpdate(100, $update);
            $this->repository->chunkDelete(100, $delete);
        });

        $request->session()->flash('status', 'Successful imported data!');

        return back();
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    private function storeImportedFile(UploadedFile $file): string
    {
        $files = Storage::allFiles(self::IMPORT_FOLDER);

        if (\count($files) >= self::HISTORY_LIMIT) {
            Storage::delete($files[0]);
        }

        $generatedFilename = (new DateTime())->format('Y-M-d H:i:s') . '.json';
        $file->storeAs(self::IMPORT_FOLDER, $generatedFilename);

        return '/import/' . $generatedFilename;
    }

    /**
     * @param string $path
     * @return array
     */
    private function prepareActionCollections(string $path): array
    {
        $fileContent = Storage::get($path);
        $parsed = $this->parser->handle($fileContent);
        $actionCollections = ['update' => new Collection(), 'delete' => new Collection()];

        ServerItem::chunk(100, function ($serverItems) use (&$parsed, &$actionCollections) {
            foreach ($serverItems as $key => $serverItem) {
                $brand = $serverItem->brand;
                $provider = $serverItem->provider;
                $isAlreadyPresentInDb = $parsed->contains(fn($item) => $item->provider === $provider && $item->brand === $brand);

                if ($isAlreadyPresentInDb === true) {
                    $parsedItemKey = $parsed->search(fn($item) => $item->provider === $provider && $item->brand === $brand);

                    $parsedItem = $parsed->pull($parsedItemKey);
                    $updatedItem = $serverItem->updateAttributes($parsedItem);
                    $actionCollections['update']->add($updatedItem);
                } else {
                    $actionCollections['delete']->add($serverItem);
                }
            }
        });

        return [
            $parsed,
            $actionCollections['update'],
            $actionCollections['delete']
        ];
    }
}
