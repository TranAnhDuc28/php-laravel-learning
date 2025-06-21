<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @param mixed ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.showLogin');
        }

        if (!in_array($user->role->value, $roles)) {
            abort(403, __('Unauthorized access.'));
        }

        return $next($request);
    }
}
