<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (!in_array($locale, ['id', 'en'])) {
            $locale = 'id';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}