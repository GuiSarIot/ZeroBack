<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regionales extends Model
{
    protected $table = 'regionales';

    protected $primaryKey = 'reg_id';

    public function centros()
    {
        return $this->hasMany(Centros::class, 'reg_id', 'cent_reg_id_fk');
    }

    public function departamentoRegional()
    {
        return $this->belongsTo(DepartamentoRegional::class, 'reg_id','dr_regional_id');
    }

}
