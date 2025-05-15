<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RolesInstitucionalesRoles;

class RolesInstitucionalesRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        RolesInstitucionalesRoles::insert([
            [
                'id' => 1,
                'rolinrol_rolin_id_fk' => 1,
                'rolinrol_rol_id_fk' => 1,
                'created_at' => null,
                'updated_at' => null,
            ]
        ]);
    }
}
