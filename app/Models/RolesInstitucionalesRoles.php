<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesInstitucionalesRoles extends Model
{
    use HasFactory;

    protected $table = 'roles_institucionales_roles';

    protected $fillable = [
        'rolinrol_rolin_id_fk',
        'rolinrol_rol_id_fk',
        'created_at',
        'updated_at'
    ];
}
