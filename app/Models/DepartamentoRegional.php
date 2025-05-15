<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentoRegional extends Model
{
    use HasFactory;

    protected $table = 'departamentos_regional';

    public function departamentos()
    {
        return $this->hasOne(Departamento::class, 'dpt_id','dr_departamento_id');
    }

    public function regionales()
    {
        return $this->hasOne(Regionales::class, 'dr_regional_id','reg_id');
    }
}
