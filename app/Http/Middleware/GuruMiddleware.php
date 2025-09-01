<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'guru') {
            abort(403, 'Akses ditolak. Hanya guru yang bisa masuk.');
        }

        return $next($request);
    }
}
