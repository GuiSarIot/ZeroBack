<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    public function usuarios()
    {
        return $this->belongsToMany(Usuarios::class, 'usuarios_roles', 'usrol_rol_id_fk', 'usrol_us_id_fk');
    }

    public function modulos_sistema()
    {
        return $this->belongsToMany(Modulos_sistema::class, 'roles_modulos_sist', 'rolmodsis_rol_id_fk', 'rolmodsis_modsis_id_fk');
    }

    public function roles_institucionales_roles()
    {
        return $this->belongsToMany(Roles_institucionales::class, 'roles_institucionales_roles', 'rolinrol_rol_id_fk', 'rolinrol_rolin_id_fk');
    }

}
