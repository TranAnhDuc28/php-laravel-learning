<?php
// app/Http/Middleware/VerifyCsrfToken.php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
//        'check-in-out/*',  // Bỏ qua CSRF cho tất cả routes bắt đầu với check-in-out/
        // hoặc chính xác hơn:
        'check-in-out/patch'
//        'api/*'
    ];
}
