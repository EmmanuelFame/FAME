<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1); // gets 'ru' from '/ru/privacy'

        if (in_array($locale, ['en', 'ru'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
