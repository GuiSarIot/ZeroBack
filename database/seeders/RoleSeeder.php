<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::insert([
            ['rol_id' => 1, 'rol_nombre' => 'Gestión de usuarios', 'rol_estado' => 'ACTIVO', 'rol_descripcion' => 'Rol para la gestion de usuarios, creación y edición de usuarios', 'rol_url' => 'gestor_usuarios']
        ]);
    }
}
