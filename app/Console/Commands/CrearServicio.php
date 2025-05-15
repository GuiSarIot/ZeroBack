<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CrearServicio extends Command
{
    protected $signature = 'crearServicio {ruta}';

    protected $description = 'Command description';

    public function handle()
    {
        $ruta = $this->argument('ruta');
        $partesRuta = explode('/', $ruta);
        $nombreArchivo = end($partesRuta).'.php';
        array_pop($partesRuta);
        $ruta = implode(',', $partesRuta);
        $rutaCarpeta = app_path("Http/services/$ruta");
        $rutaArchivo = $rutaCarpeta . '/' . $nombreArchivo;

        try {
            if (!File::isDirectory($rutaCarpeta)) {
                File::makeDirectory($rutaCarpeta, 0755, true);
            }
            if (File::exists($rutaArchivo)) {
                $this->error("El archivo ya existe: $rutaArchivo");
            }else{
                $contenido = "<?php\n\nnamespace App\Http\Services\\".$ruta.";\n\nclass " . pathinfo($nombreArchivo, PATHINFO_FILENAME) . "\n{\n    // Métodos y propiedades del servicio\n}\n";
                File::put($rutaArchivo, $contenido);
                $this->info("Archivo creado exitosamente: $rutaArchivo");
            }
        } catch (\Exception $e) {
            $this->error("No se pudo crear la carpeta: " . $e->getMessage());
        }

    }
}
