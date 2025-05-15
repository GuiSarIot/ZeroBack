<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoDocumento::insert([
            ['tipo_doc_id' => 1, 'tipo_doc_nombre' => 'Cedula de ciudadanía'],
            ['tipo_doc_id' => 2, 'tipo_doc_nombre' => 'Tarjeta de identidad'],
            ['tipo_doc_id' => 3, 'tipo_doc_nombre' => 'Pasaporte extranjero'],
            ['tipo_doc_id' => 4, 'tipo_doc_nombre' => 'Cedula de extranjería'],
            ['tipo_doc_id' => 5, 'tipo_doc_nombre' => 'DNI']

        ]);
    }
}
