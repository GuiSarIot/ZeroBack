<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipio';

    protected $primaryKey = 'mpo_id';

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'mpo_dep_id_fk', 'dpt_id');
    }

}
