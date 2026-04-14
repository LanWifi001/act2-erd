<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // 1. Check if the user is logged in
        if (!auth()->check()) {
            return redirect('login');
        }

        // 2. Check if the user has the required role (or is an admin)
        if (auth()->user()->role !== $role && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
    
}
