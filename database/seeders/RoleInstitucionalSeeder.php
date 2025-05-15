<?php

namespace Database\Seeders;

use App\Models\Roles_institucionales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleInstitucionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles_institucionales::insert([
            ['id' => 1, 'rolin_nombre' => 'Desarrollador SVP', 'rolin_estado' => 'Activo', 'rolin_descripcion' => 'Rol para el equipo de desarrollo', 'rolin_nivel_acceso' => 'ROOT']
 ]);
    }
}
