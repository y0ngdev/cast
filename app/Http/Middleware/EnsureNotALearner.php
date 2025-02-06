<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureNotALearner
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((! auth()->check() || auth()->user()->hasRole('learner'))) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
