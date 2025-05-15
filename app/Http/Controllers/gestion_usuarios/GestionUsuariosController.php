<?php

//* controllers
namespace App\Http\Controllers\gestion_usuarios;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApiController;

//* libraries
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//* services
use App\Http\Services\gestion_usuarios\GestionUsuariosService;
use App\Http\Services\gestion_usuarios\GestionUsuariosSelectsService;

class GestionUsuariosController extends Controller
{

    //* create a new user
    public function create(Request $request, GestionUsuariosService $gestionUsuariosService)
    {
        try {
            //* validate inpt data
            $validator = Validator::make($request->all(), [
                'tipoDocumento' => 'required',
                'nombres' => 'required|string',
                'apellidos' => 'required|string',
                'numeroDocumento' => 'required|numeric',
                'correoElectronicoCorporativo' => 'required|email',
                'estado' => 'required',
                'tipoVinculacion' => 'required',
                'regional' => 'required',
                'centro' => 'required',
                'nombreUsuario' => 'required|string',
                'password' => 'required|string|min:8',
                'passwordConfirm' => 'required|string|min:8|same:password'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return ResponseApiController::error($errors, 401);
            }

            $userExist = $gestionUsuariosService->validateIfUserExist($request);

            if ($userExist['process']) {
                return ResponseApiController::error('Hay campos obligatorios que no estan disponibles, porque ya estan asignados a otro usuario', 401);
            }

            $user = $gestionUsuariosService->createUser($request);

            return ResponseApiController::success($user, 201);
        } catch (\Throwable $th) {
            return ResponseApiController::error("Ha ocurrido un error, intentelo mas tarde", 500);
        }
    }

    //* create a new rol institutional
    public function createRolin(Request $request, GestionUsuariosService $gestionUsuariosService)
    {
        try {
            //* validate inpt data
            $validator = Validator::make($request->all(), [
                'nameRol' => 'required|string',
                'rolesAccess' => 'required|array',
                'rolState' => 'required|string',
                'rolDescription' => 'string',
                'rolLevelAccess' => 'required|string',
            ]);

            if ($validator->fails()) {
                return ResponseApiController::error('Error en la validaciones, revise correctamente los campos', 401);
            }

            $rolIn = $gestionUsuariosService->createRolin($request);

            return ResponseApiController::success($rolIn, 200, "Rol Institucional creado");
        } catch (\Throwable $th) {
            return ResponseApiController::error("Ha ocurrido un error, intentelo mas tarde", 500);
        }
    }

    //* update an user
    public function update(Request $request, GestionUsuariosService $gestionUsuariosService)
    {
        try {

            //* validate inpt data
            $validator = Validator::make($request->all(), [
                'tipoDocumento' => 'required',
                'nombres' => 'required|string',
                'apellidos' => 'required|string',
                'numeroDocumento' => 'required|numeric',
                'correoElectronicoCorporativo' => 'required|email',
                'estado' => 'required',
                'tipoVinculacion' => 'required',
                'regional' => 'required',
                'centro' => 'required',
                'nombreUsuario' => 'required|string',
                'password' => 'required|string|min:8',
                'passwordConfirm' => 'required|string|min:8|same:password'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return ResponseApiController::error($errors, 401);
            }

            $idUser = $request->route('id');

            $userUpdated = $gestionUsuariosService->updateUser($idUser, $request);

            if (!$userUpdated['process']) {
                return ResponseApiController::error([
                    'error' => 'User not found',
                    'description' => 'Usuario no encontrado'
                ], 404);
            }

            return ResponseApiController::success($userUpdated['data'], 200);
        } catch (\Throwable $th) {
            return ResponseApiController::error("Ha ocurrido un error, intentelo mas tarde", 500);
        }
    }

    //* update a rol institutional
    public function updateRolIn(Request $request, GestionUsuariosService $gestionUsuariosService)
    {
        try {

            $idRolIn = $request->route('id');

            //* validate inpt data
            $validator = Validator::make($request->all(), [
                'nameRol' => 'required|string',
                'rolesAccess' => 'required|array',
                'rolState' => 'required',
                'rolDescription' => 'string',
                'rolLevelAccess' => 'required|string',
            ]);

            if ($validator->fails()) {
                return ResponseApiController::error('Error en la validaciones, revise correctamente los campos', 401);
            }

            $rolInUpdated = $gestionUsuariosService->updateRolIn($idRolIn, $request);

            if (!$rolInUpdated['process']) {
                return ResponseApiController::error([
                    'error' => 'Rol Institucional not found',
                    'description' => 'Rol Institucional no encontrado'
                ], 404);
            }

            return ResponseApiController::success($rolInUpdated['data'], 200, "Rol Institucional actualizado");
        } catch (\Throwable $th) {
            return ResponseApiController::error([
                'line' => $th->getLine(),
                'message' => $th->getMessage(),
                'file' => $th->getFile()
            ], 500);
        }
    }

    //* sear an user
    public function getUsers(Request $request, GestionUsuariosService $gestionUsuariosService)
    {
        try {
            $users = $gestionUsuariosService->findUsers($request->idCurrentUser);

            if (count($users) == 0) {
                return ResponseApiController::success([]);
            }

            return ResponseApiController::success($users);
        } catch (\Throwable $th) {
            return ResponseApiController::error("Ha ocurrido un error, intentelo mas tarde", 500);
        }
    }

    //* get user info
    public function getUserInfo(Request $request, GestionUsuariosService $gestionUsuariosService)
    {
        $id = $request->route('id');

        if ($id == '') {
            return ResponseApiController::error('ID no encontrado', 404);
        }

        $user = $gestionUsuariosService->getAllUserInfo($id);

        if (!$user['process']) {
            return ResponseApiController::error('User not found', 404);
        }

        return ResponseApiController::success([
            'infoUser' => $user['data']
        ], 200, 'User info');
    }

    //* get type documents info
    public function getTypeDocuments(Request $request, GestionUsuariosSelectsService $gestionUsuariosSelectsService)
    {
        return ResponseApiController::success($gestionUsuariosSelectsService->getTypeDocuments());
    }

    //* get regions info
    public function getRegions(Request $request, GestionUsuariosSelectsService $gestionUsuariosSelectsService)
    {
        return ResponseApiController::success($gestionUsuariosSelectsService->getRegions());
    }

    //* get centers info
    public function getRegionCenters(Request $request, GestionUsuariosSelectsService $gestionUsuariosSelectsService)
    {
        $id = $request->route('id');
        return ResponseApiController::success($gestionUsuariosSelectsService->getCenters($id));
    }

    //* get centers info
    public function getRolsUsers(Request $request, GestionUsuariosSelectsService $gestionUsuariosSelectsService)
    {
        return ResponseApiController::success($gestionUsuariosSelectsService->getRoles());
    }


    //* get roles institutionals
    public function getRolesIn(Request $request, GestionUsuariosSelectsService $gestionUsuariosSelectsService)
    {
        try {
            $rols = $gestionUsuariosSelectsService->getRolesIn();
            return ResponseApiController::success($rols);
        } catch (\Throwable $th) {
            return ResponseApiController::error("Ha ocurrido un error, intentelo mas tarde", 500);
        }
    }

    //* get a rol institutional
    public function getRolIn(Request $request, GestionUsuariosSelectsService $gestionUsuariosSelectsService)
    {
        try {
            $idRolIn = $request->route('id');
            $rols = $gestionUsuariosSelectsService->getRolIn($idRolIn);
            return ResponseApiController::success($rols);
        } catch (\Throwable $th) {
            return ResponseApiController::error("Ha ocurrido un error, intentelo mas tarde", 500);
        }
    }

    public function deleteRecord($id, GestionUsuariosService $GestionUsuariosService)
    {
        try {
            $recordDeleted = $GestionUsuariosService->deleteRecord($id);

            if (!$recordDeleted["process"]) {
                return ResponseApiController::error($recordDeleted["message"], 505);
            }

            return ResponseApiController::success($recordDeleted["data"]);
        } catch (\Throwable $th) {
            return ResponseApiController::error("Ha ocurrido un error interno", 505);
        }
    }

    public function deleteRecordRol($id, GestionUsuariosService $GestionUsuariosService)
    {
        try {
            $recordDeleted = $GestionUsuariosService->deleteRecordRol($id);

            if (!$recordDeleted["process"]) {
                return ResponseApiController::error($recordDeleted["message"], 505);
            }

            return ResponseApiController::success($recordDeleted["data"]);
        } catch (\Throwable $th) {
            return ResponseApiController::error("Ha ocurrido un error interno", 505);
        }
    }
}
