<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class PowerUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoles = [9]; // 0: admin, 2: mod, 9: power user

        if (auth()->check() && in_array(auth()->user()->role, $allowedRoles)) {
            return $next($request);
        }

        return redirect('/')->with('error', __('messages.mesError.perDeny'));
    }
}
