<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof MethodNotAllowedHttpException) {
    //         return response()->json([
    //             'error' => 'Method Not Allowed.',
    //             'message' => 'Bad configuration in method.',
    //             // 'supported_methods' => $exception->getHeaders()['Allow'] ?? [],
    //         ], 405);
    //     }

    //     if ($exception instanceof NotFoundHttpException) {
    //         return response()->json([
    //             'error' => 'Not Found.',
    //             'message' => 'Resource not found or does not exist.',
    //         ], 404);
    //     }

    //     return response()->json([
    //         'error' => 'Internal Server Error.',
    //         'message' => 'An error occurred while processing the request.',
    //         'details' => config('app.debug') ? $exception->getMessage() : 'Contacte al administrador.',
    //     ], 500);
    // }   
}
