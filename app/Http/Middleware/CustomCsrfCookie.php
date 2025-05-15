<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CustomCsrfCookie
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Marcar XSRF-TOKEN como HttpOnly
        if ($request->hasSession()) {
            Cookie::queue(
                Cookie::make('XSRF-TOKEN', $request->session()->token(), 120, '/', null, config('session.secure'), true, false, 'Lax')
            );
        }

        return $response;
    }
}
