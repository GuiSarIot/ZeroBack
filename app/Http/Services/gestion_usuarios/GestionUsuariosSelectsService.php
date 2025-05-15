<?php

namespace App\Http\Services\gestion_usuarios;

//* models
use App\Models\TipoDocumento;
use App\Models\Regionales;
use App\Models\Centros;
use App\Models\Roles;
use App\Models\Roles_institucionales;

//* libraries
use Illuminate\Support\Facades\DB;

class GestionUsuariosSelectsService
{
    /**
     * Get type documents
     *
     * @return array
     */
    public function getTypeDocuments()
    {
        return  TipoDocumento::select('tipo_doc_id  as code', 'tipo_doc_nombre as name')->get();
    }

    /**
     * Get regions
     *
     * @return array
     */
    public function getRegions()
    {
        return  Regionales::select('reg_id as code', 'reg_nombre as name')->get();
    }

    /**
     * Get centers
     *
     * @param string $id
     *
     * @return array
     */
    public function getCenters($id)
    {
        if ($id == '') {
            return  Centros::select('cent_id as code', 'cent_nombre as name')->get();
        }

        return  Centros::select('cent_id as code', 'cent_nombre as name')->where('cent_reg_id_fk', $id)->get();
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return  Roles::select('rol_id  as code', 'rol_nombre as name', 'rol_descripcion as description')->where('rol_estado', 'ACTIVO')->get();
    }

    /**
     * Get roles in
     *
     * @return array
     */
    public function getRolesIn()
    {
        $rols = Roles_institucionales::select(
            'roles_institucionales.id  as code',
            'roles_institucionales.rolin_nombre as name',
            'roles_institucionales.rolin_descripcion as description',
            'roles_institucionales.rolin_estado as state',
            'roles_institucionales.rolin_nivel_acceso as access_level',
            DB::raw('GROUP_CONCAT(roles.rol_nombre) as access_roles')
        )->join('roles_institucionales_roles', 'roles_institucionales_roles.rolinrol_rolin_id_fk', '=', 'roles_institucionales.id')
        ->join('roles', 'roles.rol_id', '=', 'roles_institucionales_roles.rolinrol_rol_id_fk')
        ->groupBy('roles_institucionales.id')
        ->groupBy('roles_institucionales.rolin_nombre')
        ->groupBy('roles_institucionales.rolin_descripcion')
        ->groupBy('roles_institucionales.rolin_nivel_acceso')
        ->groupBy('roles_institucionales.rolin_estado')
        ->orderBy('roles_institucionales.rolin_nivel_acceso', 'desc')
        ->get();

        $rols->transform(function ($item, $key) {
            $item->access_roles = explode(',', $item->access_roles);
            return $item;
        });

        return $rols;
    }

    /**
     * Get rol in
     *
     * @param int $idRolIn
     *
     * @return array
     */
    public function getRolIn($idRolIn)
    {
        $rols = Roles_institucionales::select(
            'roles_institucionales.id  as code',
            'roles_institucionales.rolin_nombre as name',
            'roles_institucionales.rolin_descripcion as description',
            'roles_institucionales.rolin_estado as state',
            'roles_institucionales.rolin_nivel_acceso as access_level',
            DB::raw('GROUP_CONCAT(JSON_OBJECT("code", roles.rol_id, "name", roles.rol_nombre)) as access_roles')
        )->join('roles_institucionales_roles', 'roles_institucionales_roles.rolinrol_rolin_id_fk', '=', 'roles_institucionales.id')
        ->join('roles', 'roles.rol_id', '=', 'roles_institucionales_roles.rolinrol_rol_id_fk')
        ->groupBy('roles_institucionales.id')
        ->groupBy('roles_institucionales.rolin_nombre')
        ->groupBy('roles_institucionales.rolin_descripcion')
        ->groupBy('roles_institucionales.rolin_estado')
        ->groupBy('roles_institucionales.rolin_nivel_acceso')
        ->where('roles_institucionales.id', $idRolIn)
        ->first();

        $rols->access_roles = json_decode('[' . $rols->access_roles . ']', true);

        return $rols;
    }

}
