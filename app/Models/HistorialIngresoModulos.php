<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialIngresoModulos extends Model
{
    use HasFactory;

    protected $table = 'historial_ingreso_modulos'; // Nombre exacto de la tabla

    protected $fillable = [
        'him_us_id',
        'him_rol_id',
        'him_mod_name',
        'fecha_ing',
    ];
}
