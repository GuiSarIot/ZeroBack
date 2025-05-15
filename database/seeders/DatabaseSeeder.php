<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Centros;
use App\Models\Municipio;
use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            DepartamentoSeeder::class,
            MunicipioSeeder::class,
            TipoDocumentoSeeder::class,
            RegionalSeeder::class,
            CentroSeeder::class,
            RoleSeeder::class,
            RoleInstitucionalSeeder::class,
            RolesInstitucionalesRolesSeeder::class,
            UsuariosSeeder::class,
            HistorialIngresoModulosSeeder::class,

        ]);
    }
}
