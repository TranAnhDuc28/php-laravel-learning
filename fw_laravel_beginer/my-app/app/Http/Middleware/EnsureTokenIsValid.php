<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     * Middleware kiểm tra token hợp lệ trước khi tiếp tục xử lý request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (env('SECRET_TOKEN') != $request->input('token')) {
            abort(403);
        }

        // Nếu token hợp lệ, tiếp tục request
        return $next($request);
    }
}
