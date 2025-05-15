<?php

namespace App\Http\Services\login;

//* models
use App\Models\Usuarios;

//* libraries
use Illuminate\Support\Facades\DB;


class LoginService
{

    /**
     * Find user by name
     *
     * @param string $userName
     *
     * @return object
     *
     */
    public function findUserByname($userName)
    {
        return Usuarios::join('roles_institucionales as rolin', 'rolin.id', '=', 'usuarios.us_rol_institucional', 'left')->where('us_nombre_login', $userName)->first();
    }

    /**
     * Find user by ID
     *
     * @param int $userID
     *
     * @return object
     *
     */
    public function findUserById($userID)
    {
        return Usuarios::join('roles_institucionales as rolin', 'rolin.id', '=', 'usuarios.us_rol_institucional', 'left')->where('us_id', $userID)->first();
    }

    /**
     * Get user roles
     *
     * @param int $userID
     *
     * @return object
     *
     */
    public function getUserRols($userID)
    {
        $rols = DB::table('usuarios_roles', 'ur')
        ->select([
            'rol_nombre as role',
            'rol_descripcion as description',
            'rol_url as url'
        ])
        ->join('usuarios', 'ur.usrol_us_id_fk', '=', 'usuarios.us_id', 'left')
        ->join('roles', 'ur.usrol_rol_id_fk', '=', 'roles.rol_id', 'left')
        ->where('ur.usrol_us_id_fk', $userID)
        ->where('roles.rol_estado', 'ACTIVO')
        ->get();

        return $rols;
    }

    /**
     * Get user roles institutional
     *
     * @param int $userRolInstitutional
     *
     * @return object
     *
     */
    public function getUserRolsIntitutional($userRolInstitutional)
    {
        $rols = DB::table('roles_institucionales', 'rolIn')
        ->select([
            'roles.rol_nombre as role',
            'roles.rol_descripcion as description',
            'roles.rol_url as url'
        ])
        ->join('usuarios as us', 'us.us_rol_institucional', '=', 'rolIn.id')
        ->join('roles_institucionales_roles as rolInRol', 'rolInRol.rolinrol_rolin_id_fk', '=', 'rolIn.id')
        ->join('roles', 'roles.rol_id', '=', 'rolInRol.rolinrol_rol_id_fk')
        ->where('us.us_rol_institucional', $userRolInstitutional)
        ->where('roles.rol_estado', 'ACTIVO')
        ->where('rolIn.rolin_estado', 'ACTIVO')
        ->distinct()
        ->get();

        return $rols;
    }
}
