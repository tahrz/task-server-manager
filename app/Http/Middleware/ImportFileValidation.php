<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class ImportFileValidation
 * @package App\Http\Middleware
 */
class ImportFileValidation
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'dump' => 'required|mimes:json|max:512',
        ]);

        return $next($request);
    }
}
