<?php

use App\Http\Controllers\Emails\EnviarCorreoController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'emails'], function () {
    Route::post('/prueba', [EnviarCorreoController::class, 'enviarNotificacion']);
    
});
