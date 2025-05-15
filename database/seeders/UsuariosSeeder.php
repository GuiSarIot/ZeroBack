<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuarios;
use Carbon\Carbon;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        Usuarios::insert([
            [
                'us_id' => 1,
                'us_num_doc' => '1005815469',
                'us_nombre_login' => 'jplopezr',
                'us_nombre' => 'Juan Pablo',
                'us_apellido' => 'López Reinoso',
                'us_password' => 'eyJpdiI6IloxRWNGYkRZR3VhUmoyVFkwZG9BTUE9PSIsInZhbHVlIjoiQTZBRzlMQW1pL25vRUFydVI0U0VFQT09IiwibWFjIjoiOGFiZmYzMzMzZDY0MzEwZDg5ZDhlMWRlMmQzNjFkODQzMDBjY2M1ZWVlOGZiMDFkZDEwZDJkYmIwZjc2MGMwYyIsInRhZyI6IiJ9',
                'us_email_institucional' => 'jplopezr@sena.edu.co',
                'us_email_alternativo' => 'juanpablolr2011@hotmail.com',
                'us_skpye' => 'live:juanpablolr2011',
                'us_telefono' => '3144502555',
                'us_image' => '1005815469.gif',
                'us_estado' => 'ACTIVO',
                'us_origen' => 'Ibagué',
                'us_ultima_integracion' => Carbon::parse('2024-05-28 17:43:29'),
                'us_estado_password' => null,
                'us_tipo_vinculacion' => 'CONTRATISTA',
                'us_profesion' => 'Ingeniero de sistemas',
                'us_contrato_inicio' => Carbon::parse('2024-02-01 05:00:00'),
                'us_contrato_fin' => Carbon::parse('2024-12-31 05:00:00'),
                'us_rol_institucional' => 1,
                'us_tipo_doc_id_fk' => 1,
                'us_cent_id_fk' => 9101,
                'created_at' => Carbon::parse('2024-05-28 17:43:29'),
                'updated_at' => Carbon::parse('2025-02-11 16:18:58'),
            ]
        ]);
    }
}
