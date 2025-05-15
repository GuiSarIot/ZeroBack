<?php

namespace Database\Seeders;

use App\Models\Regionales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Regionales::insert([
            ['reg_id' => 0, 'reg_nombre' => 'NINGUNO'],
            ['reg_id' => 5, 'reg_nombre' => 'ANTIOQUIA'],
            ['reg_id' => 8, 'reg_nombre' => 'ATLÁNTICO'],
            ['reg_id' => 11, 'reg_nombre' => 'DISTRITO CAPITAL'],
            ['reg_id' => 13, 'reg_nombre' => 'BOLÍVAR'],
            ['reg_id' => 15, 'reg_nombre' => 'BOYACÁ'],
            ['reg_id' => 17, 'reg_nombre' => 'CALDAS'],
            ['reg_id' => 18, 'reg_nombre' => 'CAQUETÁ'],
            ['reg_id' => 19, 'reg_nombre' => 'CAUCA'],
            ['reg_id' => 20, 'reg_nombre' => 'CESAR'],
            ['reg_id' => 23, 'reg_nombre' => 'CÓRDOBA'],
            ['reg_id' => 25, 'reg_nombre' => 'CUNDINAMARCA'],
            ['reg_id' => 27, 'reg_nombre' => 'CHOCÓ'],
            ['reg_id' => 41, 'reg_nombre' => 'HUILA'],
            ['reg_id' => 44, 'reg_nombre' => 'GUAJIRA'],
            ['reg_id' => 47, 'reg_nombre' => 'MAGDALENA'],
            ['reg_id' => 50, 'reg_nombre' => 'META'],
            ['reg_id' => 52, 'reg_nombre' => 'NARIÑO'],
            ['reg_id' => 54, 'reg_nombre' => 'NORTE DE SANTANDER'],
            ['reg_id' => 63, 'reg_nombre' => 'QUINDÍO'],
            ['reg_id' => 66, 'reg_nombre' => 'RISARALDA'],
            ['reg_id' => 68, 'reg_nombre' => 'SANTANDER'],
            ['reg_id' => 70, 'reg_nombre' => 'SUCRE'],
            ['reg_id' => 73, 'reg_nombre' => 'TOLIMA'],
            ['reg_id' => 76, 'reg_nombre' => 'VALLE'],
            ['reg_id' => 81, 'reg_nombre' => 'ARAUCA'],
            ['reg_id' => 85, 'reg_nombre' => 'CASANARE'],
            ['reg_id' => 86, 'reg_nombre' => 'PUTUMAYO'],
            ['reg_id' => 88, 'reg_nombre' => 'SAN ANDRÉS'],
            ['reg_id' => 91, 'reg_nombre' => 'AMAZONAS'],
            ['reg_id' => 94, 'reg_nombre' => 'GUAINÍA'],
            ['reg_id' => 95, 'reg_nombre' => 'GUAVIARE'],
            ['reg_id' => 97, 'reg_nombre' => 'VAUPÉS'],
            ['reg_id' => 99, 'reg_nombre' => 'VICHADA'],
            ['reg_id' => 134, 'reg_nombre' => 'NINGUNO']
        ]);
    }
}
