<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamento';
    protected $primaryKey = 'dpt_id';

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'mpo_dep_id_fk', 'dpt_id');
    }

    public function departamentoRegional()
    {
        return $this->belongsTo(DepartamentoRegional::class, 'dr_departamento_id','dpt_id');
    }
}
