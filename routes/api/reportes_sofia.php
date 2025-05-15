<?php

use App\Http\Controllers\reportes_sofia\ReportSofiaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'reportes_sofia', 'middleware' => 'validateToken'], function () {
    //* get methods
    Route::get('/info_usuario/{id}', [ReportSofiaController::class, 'loadUserInfo']);

    Route::group(['prefix' => 'aprendices'], function () {
        //* post methods
        Route::post('/etapa_productiva', [ReportSofiaController::class, 'getReportProductiveStage']);
        Route::post('/alternativas_ep_registradas', [ReportSofiaController::class, 'getReportAlternativeProductiveStageRegistred']);
    });
});
