<?php

use App\Http\Controllers\update_personal_info\UpdatePersonalInfoController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'update_personal_info', 'middleware' => 'validateToken'], function () {
    //* get methods
    Route::get('/user_personal_info/{id}', [UpdatePersonalInfoController::class, 'getUserPersonalInfo']);

    //* put methods
    Route::put('/actualizar_personal_info/{id}', [UpdatePersonalInfoController::class, 'updatePersonalInfo']);
});
