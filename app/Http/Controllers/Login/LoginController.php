<?php

namespace App\Http\Controllers\login;

//* controllers
use App\Http\Controllers\Controller;
use App\Http\Controllers\EncryptionController;
use App\Http\Controllers\ResponseApiController;
use App\Http\Controllers\ManageTokenController;

//* services
use App\Http\Services\login\LoginService;

//* libraries
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function authenticate(Request $request, LoginService $loginService)
    {

        //* validations
        $validator = Validator::make($request->all(), [
            'userName' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return ResponseApiController::error('Error en la validaciones, revise los campos', 400);
        }

        //* validate user
        $user = $loginService->findUserByname($request->userName);

        if (!$user) {
            return ResponseApiController::error('Usuario no encontrado', 401);
        }

        if (EncryptionController::decrypt($user->us_password) != $request->password) {
            return ResponseApiController::error('Contraseña incorrecta', 401);
        }

        if ($user->us_estado !== 'ACTIVO') {
            return ResponseApiController::error('El usuario está inactivo', 401);
        }

        //* generating token
        $token = ManageTokenController::generateToken($user->us_id);

        //* getting user roles
        $roles = $loginService->getUserRols($user->us_id);

        //* getting user roles institutionals
        $rolsInstitutionals = $loginService->getUserRolsIntitutional($user->us_rol_institucional);

        $roles = collect($roles)->merge($rolsInstitutionals)->unique('url')->values()->all();

        if (count($roles) == 0) {
            return ResponseApiController::error('El usuario no tiene roles, contacte a su administrador', 401);
        }

        //* user logged
        $responseData = [
            'id' => $user->us_id,
            'token' => $token,
            'name' => $user->us_nombre . ' ' . $user->us_apellido,
            'email' => $user->us_email_institucional,
            'module' => $roles[0]->url,
            'role' => $roles[0],
            'roles' => $roles,
            'name_image' => $user->us_image,
            'rol_intitutional' => $user->rolin_nombre,
            'rol_intitutional_level_access' => $user->rolin_nivel_acceso,
            'has_rol_intitutional' => $user->rolin_nombre ? true : false
        ];

        return ResponseApiController::success($responseData, 200, 'User logged');
    }

    public function getUserInfo(Request $request, LoginService $loginService)
    {

        try {
            $id = $request->route('id');

            if ($id == 'false') {
                return ResponseApiController::error('ID no encontrado', 404);
            }

            $id = EncryptionController::decrypt($id);

            if ($id == '') {
                return ResponseApiController::error('ID no encontrado', 404);
            }

            $user = $loginService->findUserById($id);

            if (!$user) {
                return ResponseApiController::error('Usuario no encontrado', 404);
            }

            if ($user->us_estado !== 'ACTIVO') {
                return ResponseApiController::error('El usuario está inactivo', 401);
            }

            //* getting user roles
            $roles = $loginService->getUserRols($user->us_id);

            //* gettint user roles institutionals
            $rolsInstitutionals = $loginService->getUserRolsIntitutional($user->us_rol_institucional);

            $roles = collect($roles)->merge($rolsInstitutionals)->unique('url')->values()->all();

            if (count($roles) == 0) {
                return ResponseApiController::error('El usuario no tiene roles, contacte a su administrador', 401);
            }

            $responseData = [
                'id' => $user->us_id,
                'name' => $user->us_nombre . ' ' . $user->us_apellido,
                'email' => $user->us_email_institucional,
                'module' => $roles[0]->url,
                'role' => $roles[0],
                'roles' => $roles,
                'name_image' => $user->us_image,
                'rol_intitutional' => $user->rolin_nombre,
                'rol_intitutional_level_access' => $user->rolin_nivel_acceso,
                'has_rol_intitutional' => $user->rolin_nombre ? true : false
            ];

            return ResponseApiController::success($responseData, 200, 'User info');
        } catch (\Throwable $th) {
            return ResponseApiController::error($th->getMessage(), 505);
        }
    }

    public function encryptID(Request $request)
    {
        $id = $request->route('id');

        if ($id == '') {
            return ResponseApiController::error('ID no encontrado', 404);
        }

        $encryptedID = EncryptionController::encrypt($id);

        return ResponseApiController::success($encryptedID, 200, 'ID encrypted');
    }

    public function decryptID(Request $request)
    {
        $id = $request->route('id');

        if ($id == '') {
            return ResponseApiController::error('ID no encontrado', 404);
        }

        $decryptedID = EncryptionController::decrypt($id);

        return ResponseApiController::success($decryptedID, 200, 'ID decrypted');
    }
}
