<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     * @param array $role
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$role): Response
    {
        return $next($request);
    }
}
