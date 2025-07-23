<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuthor
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth('author')->check()) {
            return response()->json(['message' => 'Unauthorized - Author access required'], 403);
        }

        return $next($request);
    }
}
