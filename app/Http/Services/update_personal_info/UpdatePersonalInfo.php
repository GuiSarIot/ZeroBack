<?php

namespace App\Http\Services\update_personal_info;

//* controllers
use App\Http\Controllers\EncryptionController;

//* models
use App\Models\Usuarios;

//* libraries
use Illuminate\Support\Facades\DB;


class UpdatePersonalInfo
{

    /**
     ** Get user personal info
     * 
     * @param int $idUser
     * 
     * @return array
     */
    public function getUserPersonalInfo($idUser)
    {
        $user = DB::table('usuarios', 'us')
            ->select([

                'us_nombre as name',
                'us_apellido as lastname',
                'us_email_institucional as emailI',
                'us_id as id',
                'us_nombre_login as userName',
                'us_num_doc as userNumDoc',
                'us_email_alternativo as userEmailA',
                'us_skpye as userSkype',
                'us_telefono as userPhone',
                'us_image as userImage',
                'us_origen as userOrigin',
                'us_password as userPassword',
                'us_estado_password as userStatePassword',
                'us_tipo_vinculacion as userTypeLink',
                'us_profesion as userProfession',
                'us_tipo_doc_id_fk as userTypeDocument',
                'tipo_documento.tipo_doc_nombre as typeDocumentName'
            ])
            ->join('tipo_documento', 'us.us_tipo_doc_id_fk', '=', 'tipo_documento.tipo_doc_id')
            ->where('us.us_id', $idUser)
            ->first();

        if (!$user) {
            return [
                'process' => false,
                'message' => 'User not found'
            ];
        }

        $user->userPassword = EncryptionController::decrypt($user->userPassword);

        $responseData = [
            'infoUser' => $user
        ];

        return [
            'process' => true,
            'data' => $responseData
        ];
    }


    /**
     ** get user personal info before update
     * 
     * @param array $dataUser
     * 
     * @return array
     */
    public function validateIfUserExist($userInfo, $idUser)
    {
        //* find by us_skpye
        $user = Usuarios::where('us_skpye',  $userInfo->skype)
            ->where('us_id', '!=', $idUser)
            ->first();

        if ($user) {
            return [
                'process' => true,
                'message' => 'Usuario ya existe',
                'data' => $user
            ];
        }

        return [
            'process' => false,
            'message' => 'Usuario no existe',
            'data' => null
        ];
    }



    /**
     ** Update personal info
     * 
     * @param array $dataUser
     * 
     * @return array
     */

    public function updatePersonalInfo($idUser, $infoUser)
    {
        $user = Usuarios::select()->where('us_id', $idUser)->first();

        if (!$user) {
            return [
                'process' => false,
                'message' => 'User not found'
            ];
        }

        $user->us_id = $idUser;
        $user->us_num_doc = $infoUser->numeroDocumento;
        $user->us_nombre_login = $infoUser->nombreUsuario;
        $user->us_nombre = $infoUser->nombres;
        $user->us_apellido = $infoUser->apellidos;
        $user->us_password = EncryptionController::encrypt($infoUser->password);
        $user->us_email_institucional = $infoUser->correoElectronicoCorporativo;
        $user->us_email_alternativo = $infoUser->correoElectronico;
        $user->us_skpye = $infoUser->skype;
        $user->us_telefono = $infoUser->numeroTelefono;
        $user->us_tipo_vinculacion = $infoUser->tipoVinculacion;
        $user->us_profesion = $infoUser->profesion;
        $user->us_tipo_doc_id_fk = $infoUser->tipoDocumento;
        $user->us_image = count($infoUser->profilePicture) > 0 ? $infoUser->numeroDocumento.'.'.$infoUser->profilePicture['type'] : 'no_photo.jpg';

        $user->save();

        return [
            'process' => true,
            'data' => $user
        ];
    }
}
