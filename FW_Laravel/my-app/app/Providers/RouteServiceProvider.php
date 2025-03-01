<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     *  - Định nghĩa giới hạn tốc độ (Rate Limiting) cho API.
     *  - Cho phép tối đa 3 request/phút trên mỗi user hoặc địa chỉ IP.
     *  - Nếu user đã đăng nhập, giới hạn theo `user_id`, nếu chưa thì theo `IP`.
     */
    public function boot(): void
    {
        //
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(3)->by($request->user()?->id ?: $request->ip());
        });
    }
}
