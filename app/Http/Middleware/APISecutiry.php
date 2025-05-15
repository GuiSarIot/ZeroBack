<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ResponseApiController;
use Illuminate\Support\Facades\Redirect;

class APISecutiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!($request->hasHeader('Content-type'))) {
            // return Redirect::to('https://sava.sena.edu.co');
        }

        return $next($request);
    }
}
