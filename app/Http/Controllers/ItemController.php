<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Model\ServerItem;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Repository\ItemRepositoryInterface;

/**
 * Class ItemController
 * @package App\Http\Controllers
 */
class ItemController extends Controller
{
    /**
     * @var ItemRepositoryInterface
     */
    private ItemRepositoryInterface $repository;

    /**
     * @param ItemRepositoryInterface $itemRepository
     */
    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->repository = $itemRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $items = ServerItem::orderBy('created_at', 'desc')->paginate(15);

        return view('server-list', [
            'items' => $items
        ]);
    }

    /**
     * @return View
     */
    public function add(): view
    {
        return view('server-add');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->repository->store(new ServerItem($request->all()));

        return redirect()->route('server-list');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): view
    {
        $item = ServerItem::findOrFail($id);

        return view('server-add', [
            'item' => $item
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->repository->update(ServerItem::findOrFail($id), $request->all());

        $request->session()->flash('status', 'Successful updated!');

        return back()->withInput($request->all());
    }

    /**
     * @param int $id
     * @return View
     */
    public function view(int $id): view
    {
        $item = ServerItem::findOrFail($id);

        return view('server-view', [
            'item' => $item
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $item = ServerItem::findOrFail($id);
        $this->repository->delete($item);

        return redirect()->route('server-list');
    }
}
