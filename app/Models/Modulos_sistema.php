<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulos_sistema extends Model
{
    protected $table = 'modulos_sist';

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'roles_modulos_sist', 'rolmodsis_modsis_id_fk', 'rolmodsis_rol_id_fk');
    }
}
