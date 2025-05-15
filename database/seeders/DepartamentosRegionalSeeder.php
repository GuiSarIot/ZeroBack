<?php

namespace Database\Seeders;

use App\Models\DepartamentoRegional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentosRegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DepartamentoRegional::insert([
            ['dr_departamento_id'=> 57005,'dr_regional_id'=> 5],
            ['dr_departamento_id'=> 57008, 'dr_regional_id'=>8],
            ['dr_departamento_id'=> 57011, 'dr_regional_id'=>11],
            ['dr_departamento_id'=> 57013, 'dr_regional_id'=>13],
            ['dr_departamento_id'=> 57015, 'dr_regional_id'=>15],
            ['dr_departamento_id'=> 57017, 'dr_regional_id'=>17],
            ['dr_departamento_id'=> 57018, 'dr_regional_id'=>18],
            ['dr_departamento_id'=> 57019, 'dr_regional_id'=>19],
            ['dr_departamento_id'=> 57020, 'dr_regional_id'=>20],
            ['dr_departamento_id'=> 57023, 'dr_regional_id'=>23],
            ['dr_departamento_id'=> 57025, 'dr_regional_id'=>25],
            ['dr_departamento_id'=> 57027, 'dr_regional_id'=>27],
            ['dr_departamento_id'=> 57041, 'dr_regional_id'=>41],
            ['dr_departamento_id'=> 57044, 'dr_regional_id'=>44],
            ['dr_departamento_id'=> 57047, 'dr_regional_id'=>47],
            ['dr_departamento_id'=> 57050, 'dr_regional_id'=>50],
            ['dr_departamento_id'=> 57052, 'dr_regional_id'=>52],
            ['dr_departamento_id'=> 57054, 'dr_regional_id'=>54],
            ['dr_departamento_id'=> 57063, 'dr_regional_id'=>63],
            ['dr_departamento_id'=> 57066, 'dr_regional_id'=>66],
            ['dr_departamento_id'=> 57068, 'dr_regional_id'=>68],
            ['dr_departamento_id'=> 57070, 'dr_regional_id'=>70],
            ['dr_departamento_id'=> 57073, 'dr_regional_id'=>73],
            ['dr_departamento_id'=> 57076, 'dr_regional_id'=>76],
            ['dr_departamento_id'=> 57081, 'dr_regional_id'=>81],
            ['dr_departamento_id'=> 57085, 'dr_regional_id'=>85],
            ['dr_departamento_id'=> 57086, 'dr_regional_id'=>86],
            ['dr_departamento_id'=> 57088, 'dr_regional_id'=>88],
            ['dr_departamento_id'=> 57091, 'dr_regional_id'=>91],
            ['dr_departamento_id'=> 57094, 'dr_regional_id'=>94],
            ['dr_departamento_id'=> 57095, 'dr_regional_id'=>95],
            ['dr_departamento_id'=> 57097, 'dr_regional_id'=>97],
            ['dr_departamento_id'=> 57099, 'dr_regional_id'=>99]
        ]);
    }
}
