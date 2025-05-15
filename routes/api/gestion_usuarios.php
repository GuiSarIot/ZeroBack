<?php

use App\Http\Controllers\gestion_usuarios\GestionUsuariosController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'gestion_usuarios', 'middleware' => 'validateToken'], function () {
    //* get methods
    Route::get('/userInfo/{id}', [GestionUsuariosController::class, 'getUserInfo']);
    Route::get('/regional_centros/{id}', [GestionUsuariosController::class, 'getRegionCenters']);
    Route::get('/tipos_documentos', [GestionUsuariosController::class, 'getTypeDocuments']);
    Route::get('/roles_usuario', [GestionUsuariosController::class, 'getRolsUsers']);
    Route::get('/regionales', [GestionUsuariosController::class, 'getRegions']);
    Route::get('/get_roles_institucionales', [GestionUsuariosController::class, 'getRolesIn']);
    Route::get('/get_roles_institucional/{id}', [GestionUsuariosController::class, 'getRolIn']);

    //* post methods
    Route::post('/crear', [GestionUsuariosController::class, 'create']);
    Route::post('/usuarios', [GestionUsuariosController::class, 'getUsers']);
    Route::post('/crear_rol_institucional', [GestionUsuariosController::class, 'createRolin']);

    //* put methods
    Route::put('/actualizar/{id}', [GestionUsuariosController::class, 'update']);
    Route::put('/actualizar_rol_institucional/{id}', [GestionUsuariosController::class, 'updateRolIn']);

    //* delete methods
    Route::delete('/deleteRecord/{id}', [GestionUsuariosController::class, 'deleteRecord']);
    Route::delete('/deleteRecordRol/{id}', [GestionUsuariosController::class, 'deleteRecordRol']);
});
