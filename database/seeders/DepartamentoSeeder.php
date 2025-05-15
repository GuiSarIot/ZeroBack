<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departamento::insert([
            ['dpt_id' => 57005, 'dpt_nombre' => 'ANTIOQUIA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57008, 'dpt_nombre' => 'ATLÁNTICO', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57011, 'dpt_nombre' => 'BOGOTÁ D.C.', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57013, 'dpt_nombre' => 'BOLÍVAR', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57015, 'dpt_nombre' => 'BOYACÁ', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57017, 'dpt_nombre' => 'CALDAS', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57018, 'dpt_nombre' => 'CAQUETÁ', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57019, 'dpt_nombre' => 'CAUCA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57020, 'dpt_nombre' => 'CESAR', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57023, 'dpt_nombre' => 'CÓRDOBA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57025, 'dpt_nombre' => 'CUNDINAMARCA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57027, 'dpt_nombre' => 'CHOCÓ', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57041, 'dpt_nombre' => 'HUILA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57044, 'dpt_nombre' => 'LA GUAJIRA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57047, 'dpt_nombre' => 'MAGDALENA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57050, 'dpt_nombre' => 'META', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57052, 'dpt_nombre' => 'NARIÑO', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57054, 'dpt_nombre' => 'NORTE DE SANTANDER', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57063, 'dpt_nombre' => 'QUINDÍO', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57066, 'dpt_nombre' => 'RISARALDA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57068, 'dpt_nombre' => 'SANTANDER', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57070, 'dpt_nombre' => 'SUCRE', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57073, 'dpt_nombre' => 'TOLIMA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57076, 'dpt_nombre' => 'VALLE DEL CAUCA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57081, 'dpt_nombre' => 'ARAUCA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57085, 'dpt_nombre' => 'CASANARE', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57086, 'dpt_nombre' => 'PUTUMAYO', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57088, 'dpt_nombre' => 'SAN ANDRÉS Y PROVIDENCIA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57091, 'dpt_nombre' => 'AMAZONAS', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57094, 'dpt_nombre' => 'GUAINÍA', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57095, 'dpt_nombre' => 'GUAVIARE', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57097, 'dpt_nombre' => 'VAUPÉS', 'dpt_pai_id_fk' => 57],
            ['dpt_id' => 57099, 'dpt_nombre' => 'VICHADA', 'dpt_pai_id_fk' => 57]
        ]);
    }
}
