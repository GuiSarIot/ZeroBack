<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailQueue extends Model
{
    protected $fillable = ['correo', 'mensaje', 'estado', 'fecha_envio'];
}