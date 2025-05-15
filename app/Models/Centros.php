<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centros extends Model
{
    protected $primaryKey = 'cent_id';
    use HasFactory;

    public function regionales()
    {
        return $this->belongsTo(Regionales::class, 'cent_reg_id_fk', 'reg_id');
    }

}
