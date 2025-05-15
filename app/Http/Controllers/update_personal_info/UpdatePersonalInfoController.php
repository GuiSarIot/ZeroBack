<?php

namespace App\Http\Controllers\update_personal_info;

//* controllers
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApiController;

//* libraries
use Illuminate\Http\Request;

//* services
use App\Http\Services\update_personal_info\UpdatePersonalInfo;

class UpdatePersonalInfoController extends Controller
{

    //* get user info
    public function getUserPersonalInfo(Request $request, UpdatePersonalInfo $UpdatePersonalInfoServise)
    {
        $id = $request->route('id');

        if ($id == '') {
            return ResponseApiController::error('ID no encontrado', 404);
        }

        $response = $UpdatePersonalInfoServise->getUserPersonalInfo($id);

        if (!$response['process']) {
            return ResponseApiController::error($response['message'], 404);
        }

        return ResponseApiController::success($response['data'], 200);
    }

    //* update personal info 
    public function updatePersonalInfo(Request $request, UpdatePersonalInfo $UpdatePersonalInfoServise)
    {
        try {
            $idUser = $request->route('id');

            $userExist = $UpdatePersonalInfoServise->validateIfUserExist($request, $idUser);

            if ($userExist['process']) {
                return ResponseApiController::error('El campo de skype ingresado ya existe para otro usuario', 401);
            }

            $user = $UpdatePersonalInfoServise->updatePersonalInfo($idUser, $request);

            if ($user['process'] == false) {
                return ResponseApiController::error($user['message'], 404);
            }

            return ResponseApiController::success($user['data'], 200);
        } catch (\Throwable $th) {
            return ResponseApiController::error($th, 500);
        }
    }
}
