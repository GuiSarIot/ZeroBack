<?php 

use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'login'], function () {
    //* get methods
    Route::get('/cifrarID/{id}', [LoginController::class, 'encryptID']);
    Route::get('/userInfo/{id}', [LoginController::class, 'getUserInfo']);

    //* post methods
    Route::post('/autenticar', [LoginController::class, 'authenticate']);
});