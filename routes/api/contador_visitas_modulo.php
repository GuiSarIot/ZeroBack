<?php

use App\Http\Controllers\VisitCountController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'contador_visitas_modulo', 'middleware' => 'validateToken'], function () {
    //* post methods
    Route::post('/registrar/{id}', [VisitCountController::class, 'registerVisit']);
});
