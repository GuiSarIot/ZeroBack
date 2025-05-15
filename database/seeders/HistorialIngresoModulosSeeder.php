<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistorialIngresoModulos;
use Carbon\Carbon;

class HistorialIngresoModulosSeeder extends Seeder
{
    public function run()
    {
        HistorialIngresoModulos::insert([
            [
                'id' => 1,
                'him_us_id' => 1,
                'him_rol_id' => 1,
                'him_mod_name' => 'Gestión de usuarios',
                'fecha_ing' => Carbon::parse('2024-11-15 01:06:54'),
                'created_at' => Carbon::parse('2024-11-15 01:06:53'),
                'updated_at' => Carbon::parse('2024-11-15 01:06:53'),
            ]
        ]);
    }
}
