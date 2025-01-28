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
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ((! auth()->check() || ! auth()->user()->hasRole($role))) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
