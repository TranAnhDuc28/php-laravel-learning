<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Middleware thực hiện một số tác vụ sau khi request đã được xử lý bởi ứng dụng.
     * @param Request $request Request từ client.
     * @param Closure(Request): (Response) $next Hàm callback để xử lý request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        \Log::info('AfterMiddleware');

        return $next($request);
    }
}
