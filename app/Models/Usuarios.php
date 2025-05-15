<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'us_id';

    protected $fillable = [
        'us_num_doc',
        'us_nombre_login',
        'us_nombre',
        'us_apellido',
        'us_password',
        'us_email_institucional',
        'us_email_alternativo',
        'us_skpye',
        'us_telefono',
        'us_estado',
        'us_origen',
        'us_ultima_integracion',
        'us_estado_password',
        'us_tipo_vinculacion',
        'us_profesion',
        'us_contrato_inicio',
        'us_contrato_fin',
        'us_tipo_doc_id_fk',
        'us_cent_id_fk',
        'us_rol_institucional',
        'us_image'
    ];

    public function scopeGetCenterUser($query, $codeUser)
    {
        return $query->find($codeUser)->centro()->first('cent_id AS id');
    }

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'usuarios_roles', 'usrol_us_id_fk', 'usrol_rol_id_fk');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'us_tipo_doc_id_fk', 'tipo_doc_id');
    }

    public function centro()
    {
        return $this->belongsTo(Centros::class, 'us_cent_id_fk', 'cent_id');
    }

}
