<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios_centros_asignados extends Model
{

    protected $table = 'usuario_centros_asignados';

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'uscentasg_us_id_fk', 'us_id');
    }

}
