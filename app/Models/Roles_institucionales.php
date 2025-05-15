<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles_institucionales extends Model
{
    protected $table = 'roles_institucionales';

    public function roles_institucionales_roles()
    {
        return $this->belongsToMany(Roles::class, 'roles_institucionales_roles', 'rolinrol_rolin_id_fk', 'rolinrol_rol_id_fk');
    }
}
