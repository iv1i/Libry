<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth('admin')->check()) {
            return response()->json(['message' => 'Unauthorized - Admin access required'], 403);
        }

        return $next($request);
    }
}
