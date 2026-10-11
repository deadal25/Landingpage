<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('lang') && in_array($request->query('lang'), ['en', 'id', 'ja'])) {
            Session::put('locale', $request->query('lang'));
        }

        $locale = Session::get('locale', 'id');
        
        if (in_array($locale, ['en', 'id', 'ja'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
