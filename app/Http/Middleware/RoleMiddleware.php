<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        if (!in_array(auth()->user()->role, $roles)) {
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        return $next($request);
    }
}
