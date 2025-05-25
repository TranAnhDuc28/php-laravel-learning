<?php

namespace App\Http\Middleware;

use App\Enums\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $localeFromSession = Session::get('locale');

        if ($localeFromSession) {
            $language = Language::tryFrom($localeFromSession);

            if ($language) {
                App::setLocale($language->value);
            }
        }

        return $next($request);
    }
}
