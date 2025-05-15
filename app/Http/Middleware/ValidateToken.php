<?php

//* controllers
namespace App\Http\Middleware;
use App\Http\Controllers\ManageTokenController;

//* libraries
use Closure;
use App\Http\Controllers\ResponseApiController;

class ValidateToken
{
    
    public function handle($request, Closure $next)
    {
        $tokenState = ManageTokenController::validateToken($request);

        if (!$tokenState['state']) {
            return ResponseApiController::error($tokenState['message'], 401);
        }

        return $next($request);
    }
}
