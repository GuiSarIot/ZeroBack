<?php

namespace App\Http\Services\gestion_usuarios;

//* controllers
use App\Http\Controllers\EncryptionController;

//* models
use App\Models\Usuarios;
use App\Models\Roles_institucionales;

//* libraries
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class GestionUsuariosService
{


    //* create methods >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    /**
     * Create user
     *
     * @param object $userInfo
     *
     * @return object
     */
    public function createUser($userInfo)
    {
        $user = new Usuarios();

        $user->us_num_doc = $userInfo->numeroDocumento;
        $user->us_nombre_login = $userInfo->nombreUsuario;
        $user->us_nombre = $userInfo->nombres;
        $user->us_apellido = $userInfo->apellidos;
        $user->us_password = EncryptionController::encrypt($userInfo->password);
        $user->us_email_institucional = $userInfo->correoElectronicoCorporativo;
        $user->us_email_alternativo = $userInfo->correoElectronico;
        $user->us_skpye = $userInfo->skype;
        $user->us_telefono = $userInfo->numeroTelefono;
        $user->us_estado = $userInfo->estado;
        $user->us_origen = $userInfo->origen;
        $user->us_ultima_integracion = Carbon::parse($userInfo->ultimaIntegracion)->toDateTimeString();
        $user->us_estado_password = $userInfo->estadoPassword;
        $user->us_tipo_vinculacion = $userInfo->tipoVinculacion;
        $user->us_profesion = $userInfo->profesion;
        $user->us_contrato_inicio = Carbon::parse($userInfo->fechaInicioContrato)->toDateTimeString();
        $user->us_contrato_fin = Carbon::parse($userInfo->fechaFinContrato)->toDateTimeString();
        $user->us_tipo_doc_id_fk = $userInfo->tipoDocumento;
        $user->us_cent_id_fk = $userInfo->centro;
        $user->us_rol_institucional = $userInfo->rolInstitucional;
        $user->us_image = count($userInfo->profilePicture) > 0 ? $userInfo->numeroDocumento.'.'.$userInfo->profilePicture['type'] : 'no_photo.jpg';

        $user->save();

        //* create user rols
        $user->roles()->attach(array_map(function ($rol) {
            return $rol['code'];
        }, $userInfo->rolesUsuario));

        return $user;
    }

    /**
     * Create rol institutional
     *
     * @param object $rolinInfo
     *
     * @return object
     */
    public function createRolin($rolinInfo)
    {
        $rolIn = new Roles_institucionales();
        $rolIn->rolin_nombre = $rolinInfo->nameRol;
        $rolIn->rolin_estado = $rolinInfo->rolState;
        $rolIn->rolin_descripcion = $rolinInfo->rolDescription;
        $rolIn->rolin_nivel_acceso = $rolinInfo->rolLevelAccess;
        $rolIn->save();

        //* create roles asignates to rol institutional
        $rolIn->roles_institucionales_roles()->attach(array_map(function ($rol) {
            return $rol['code'];
        }, $rolinInfo->rolesAccess));

        return $rolIn;
    }

    //* get methods >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    /**
     * Get all users
     *
     * @param int $currentID
     *
     * @return object
     */
    public function findUserById($id)
    {
        return Usuarios::find($id);
    }

    /**
     * Get all users
     *
     * @param int $currentID
     *
     * @return object
     */
    public function findUsers($currentID)
    {

        $users = DB::table('usuarios')->select([
            'usuarios.us_id as userCode',
            'usuarios.us_num_doc as userNumDoc',
            'usuarios.us_nombre_login as userNameLogin',
            'usuarios.us_nombre as userName',
            'usuarios.us_apellido as userLastName',
            'usuarios.us_password as userPassword',
            'usuarios.us_email_institucional as userEmailInstitutional',
            'usuarios.us_email_alternativo as userEmailAlternative',
            'usuarios.us_skpye as userSkype',
            'usuarios.us_telefono as userPhone',
            'usuarios.us_image as userImage',
            'usuarios.us_estado as userState',
            'usuarios.us_origen as userOrigin',
            'usuarios.us_ultima_integracion as userLastIntegration',
            'usuarios.us_estado_password as userStatePassword',
            'usuarios.us_tipo_vinculacion as userTypeLink',
            'usuarios.us_profesion as userProfession',
            'usuarios.us_contrato_inicio as userContractStart',
            'usuarios.us_contrato_fin as userContractEnd',
            'usuarios.us_tipo_doc_id_fk as userTypeDocument',
            'usuarios.us_cent_id_fk as userCenter',
            DB::raw('GROUP_CONCAT(roles.rol_nombre) as rolName'),
            'centros.cent_nombre as centerName',
            'tipo_documento.tipo_doc_nombre as typeDocumentName'
        ])
            ->join('usuarios_roles', 'usuarios.us_id', '=', 'usuarios_roles.usrol_us_id_fk', 'left')
            ->join('roles', 'usuarios_roles.usrol_rol_id_fk', '=', 'roles.rol_id', 'left')
            ->join('centros', 'usuarios.us_cent_id_fk', '=', 'centros.cent_id')
            ->join('tipo_documento', 'usuarios.us_tipo_doc_id_fk', '=', 'tipo_documento.tipo_doc_id')
            ->groupBy('usuarios.us_id')
            ->groupBy('usuarios.us_num_doc')
            ->groupBy('usuarios.us_nombre_login')
            ->groupBy('usuarios.us_nombre')
            ->groupBy('usuarios.us_apellido')
            ->groupBy('usuarios.us_password')
            ->groupBy('usuarios.us_email_institucional')
            ->groupBy('usuarios.us_email_alternativo')
            ->groupBy('usuarios.us_skpye')
            ->groupBy('usuarios.us_telefono')
            ->groupBy('usuarios.us_image')
            ->groupBy('usuarios.us_estado')
            ->groupBy('usuarios.us_origen')
            ->groupBy('usuarios.us_ultima_integracion')
            ->groupBy('usuarios.us_estado_password')
            ->groupBy('usuarios.us_tipo_vinculacion')
            ->groupBy('usuarios.us_profesion')
            ->groupBy('usuarios.us_contrato_inicio')
            ->groupBy('usuarios.us_contrato_fin')
            ->groupBy('usuarios.us_tipo_doc_id_fk')
            ->groupBy('usuarios.us_cent_id_fk')
            ->groupBy('centros.cent_nombre')
            ->groupBy('tipo_documento.tipo_doc_nombre')
            ->where('usuarios.us_id', '!=', $currentID)
            ->get();

        return $users;
    }

    /**
     * Get all regions
     *
     * @return array
     */
    public function getAllUserInfo($userId)
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
                'us_estado as userState',
                'us_origen as userOrigin',
                'us_ultima_integracion as userLastIntegration',
                'us_password as userPassword',
                'us_estado_password as userStatePassword',
                'us_tipo_vinculacion as userTypeLink',
                'us_profesion as userProfession',
                'us_contrato_inicio as userContractStart',
                'us_contrato_fin as userContractEnd',
                'us_tipo_doc_id_fk as userTypeDocument',
                'us_cent_id_fk as userCenter',
                'regionales.reg_nombre as regionalName',
                'regionales.reg_id as regionalCode',
                'centros.cent_nombre as centerName',
                'centros.cent_id as centerCode',
                'tipo_documento.tipo_doc_nombre as typeDocumentName',
                'us_rol_institucional as rolIntitutional'
            ])
            ->join('centros', 'us.us_cent_id_fk', '=', 'centros.cent_id')
            ->join('regionales', 'centros.cent_reg_id_fk', '=', 'regionales.reg_id')
            ->join('tipo_documento', 'us.us_tipo_doc_id_fk', '=', 'tipo_documento.tipo_doc_id')
            ->where('us.us_id', $userId)
            ->first();

        if (!$user) {
            return [
                'process' => false,
                'message' => 'Usuario no encontrado',
                'data' => null
            ];
        }

        //* getting user roles
        $roles = DB::table('usuarios_roles', 'ur')
            ->select([
                'rol_id as code',
                'rol_nombre as name',
                'rol_descripcion as description',
                'rol_url as url'
            ])
            ->join('usuarios', 'ur.usrol_us_id_fk', '=', 'usuarios.us_id')
            ->join('roles', 'ur.usrol_rol_id_fk', '=', 'roles.rol_id')
            ->where('ur.usrol_us_id_fk', $user->id)
            ->where('roles.rol_estado', 'ACTIVO')
            ->get();

        $user->roles = $roles;
        $user->userPassword = EncryptionController::decrypt($user->userPassword);

        return [
            'process' => true,
            'message' => 'Usuario encontrado',
            'data' => $user
        ];
    }

    /**
     * Get user info before to create or update
     *
     * @return array
     */
    public function validateIfUserExist($userInfo)
    {
        //* find by us_email_institucional, us_num_doc, us_skpye
        $user = Usuarios::where('us_email_institucional', $userInfo->correoElectronicoCorporativo)
            ->orWhere('us_num_doc', $userInfo->numeroDocumento)
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

    //* update methods >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    /**
     * Update user
     *
     * @param int $userId
     * @param object $userInfo
     *
     * @return array
     */
    public function updateUser($userId, $userInfo)
    {
        $user = $this->findUserById($userId);

        if (!$user) {
            return [
                'process' => false,
                'message' => 'Usuario no encontrado',
                'data' => null
            ];
        }

        $user->us_id = $userId;
        $user->us_num_doc = $userInfo->numeroDocumento;
        $user->us_nombre_login = $userInfo->nombreUsuario;
        $user->us_nombre = $userInfo->nombres;
        $user->us_apellido = $userInfo->apellidos;
        $user->us_password = EncryptionController::encrypt($userInfo->password);
        $user->us_email_institucional = $userInfo->correoElectronicoCorporativo;
        $user->us_email_alternativo = $userInfo->correoElectronico;
        $user->us_skpye = $userInfo->skype;
        $user->us_telefono = $userInfo->numeroTelefono;
        $user->us_estado = $userInfo->estado;
        $user->us_origen = $userInfo->origen;
        $user->us_ultima_integracion = Carbon::parse($userInfo->ultimaIntegracion)->toDateTimeString();
        $user->us_tipo_vinculacion = $userInfo->tipoVinculacion;
        $user->us_profesion = $userInfo->profesion;
        $user->us_contrato_inicio = Carbon::parse($userInfo->fechaInicioContrato)->toDateTimeString();
        $user->us_contrato_fin = Carbon::parse($userInfo->fechaFinContrato)->toDateTimeString();
        $user->us_tipo_doc_id_fk = $userInfo->tipoDocumento;
        $user->us_cent_id_fk = $userInfo->centro;
        $user->us_rol_institucional = $userInfo->rolInstitucional;
        $user->us_image = count($userInfo->profilePicture) > 0 ? $userInfo->numeroDocumento.'.'.$userInfo->profilePicture['type'] : 'no_photo.jpg';

        $user->save();

        //* update user rols
        $user->roles()->sync(array_map(function ($rol) {
            return $rol['code'];
        }, $userInfo->rolesUsuario));

        return [
            'process' => true,
            'message' => 'Usuario actualizado correctamente',
            'data' => $user
        ];
    }

    /**
     * Update rol institutional
     *
     * @param int $rolinId
     * @param object $rolinInfo
     *
     * @return array
     */
    public function updateRolin($rolinId, $rolinInfo)
    {
        $rolIn = Roles_institucionales::find($rolinId);

        if (!$rolIn) {
            return [
                'process' => false,
                'message' => 'Rol institucional no encontrado',
                'data' => null
            ];
        }

        $rolIn->id = $rolinId;
        $rolIn->rolin_nombre = $rolinInfo->nameRol;
        $rolIn->rolin_estado = $rolinInfo->rolState;
        $rolIn->rolin_descripcion = $rolinInfo->rolDescription;
        $rolIn->rolin_nivel_acceso = $rolinInfo->rolLevelAccess;
        $rolIn->save();

        //* deleting rols system that rolin have
        DB::table('roles_institucionales_roles')->where('rolinrol_rolin_id_fk', $rolinId)
            ->delete();

        //* update roles asignates to rol institutional
        $rolIn->roles_institucionales_roles()->sync(array_map(function ($rol) {
            return $rol['code'];
        }, $rolinInfo->rolesAccess));

        return [
            'process' => true,
            'message' => 'Rol institucional actualizado correctamente',
            'data' => $rolIn
        ];
    }

    public function deleteRecord($id)
    {
        $record = Usuarios::find($id);

        if ($record == null) {
            return [
                'process' => false,
                'message' => 'No se encontró el registro',
                'data' => []
            ];
        }

        $record->delete();

        return [
            'process' => true,
            'message' => 'Registro eliminado correctamente',
            'data' => []
        ];
    }

    public function deleteRecordRol($id)
    {
        $record = Roles_institucionales::find($id);

        if ($record == null) {
            return [
                'process' => false,
                'message' => 'No se encontró el registro',
                'data' => []
            ];
        }

        //* inacticating users that have this rol
        $users = Usuarios::where('us_rol_institucional', $id)->get();

        foreach ($users as $user) {
            $user->us_rol_institucional = null;
            $user->us_estado = 'INACTIVO';
            $user->save();
        }

        $record->delete();

        return [
            'process' => true,
            'message' => 'Rol eliminado correctamente',
            'data' => []
        ];
    }

}
