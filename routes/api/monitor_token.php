<?php

use App\Http\Controllers\monitoreo_fichas\MonitoreoFichasController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'monitor_token', 'middleware' => 'validateToken'], function () {
    //* get methods
    Route::get('/get_regions', [MonitoreoFichasController::class, 'getRegions']);
    Route::get('/get_region/{id}', [MonitoreoFichasController::class, 'getRegion']);
    Route::get('/loadUserInfo/{id}', [MonitoreoFichasController::class, 'getUserInfo']);
    Route::get('/loadCenters/{id}', [MonitoreoFichasController::class, 'getCenters']);
    Route::get('/historical_programs/{centerId}', [MonitoreoFichasController::class, 'getHistoricalProgramsByCenter']);

    //* post methods
    Route::post('/info_program', [MonitoreoFichasController::class, 'infoProgram']);
    Route::post('/save_observation', [MonitoreoFichasController::class, 'saveObservation']);
});
