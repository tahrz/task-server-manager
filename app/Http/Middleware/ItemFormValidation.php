<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use App\Model\ServerItem;
use Illuminate\Http\Request;

/**
 * Class ItemFormValidation
 * @package App\Http\Middleware
 */
class ItemFormValidation
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'provider' => 'required',
            'brand' => 'required',
            'location' => 'required',
            'cpu' => 'required',
            'drive' => 'required',
            'price' => 'required'
        ]);

        $item = ServerItem::where([
            'provider' => $request->get('provider'),
            'brand' => $request->get('brand'),
            'location' => $request->get('location'),
            'cpu' => $request->get('cpu'),
            'drive' => $request->get('drive'),
            'price' => $request->get('price'),
        ])->first();

        if ($item !== null) {
            $request->session()->flash('status', 'Item with same properties already exists!');

            return back();
        }

        return $next($request);
    }
}
