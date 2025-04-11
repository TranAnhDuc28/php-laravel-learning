<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     * The following middleware would perform some task before the request is handled by the application
     *
     * Middleware thực hiện một số tác vụ trước khi request được xử lý bởi ứng dụng.
     *
     * @param Request $request  Request được gửi từ client.
     * @param Closure(Request): (Response) $next Hàm callback tiếp tục xử lý request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('BeforeMiddleware');
        // Thực hiện tác vụ trước khi request được xử lý (ví dụ: logging, authentication, kiểm tra headers, v.v.)
        \Log::info('Request received:', ['url' => $request->fullUrl(), 'method' => $request->method()]);

        return $next($request);
    }
}
