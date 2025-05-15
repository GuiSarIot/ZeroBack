<?php

namespace App\Http\Controllers;

//* controllers
use App\Http\Controllers\ResponseApiController;

//* models
use App\Models\MonitoreoFichasRedConocimiento;
use App\Models\MonitoreoFichasRegistrosCalificados;
use App\Models\Usuarios;

//* libraries
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


//* services
use Carbon\Carbon;
use DateTime;

class ManageCSVController extends Controller
{

    public function generateJson($csvPath, $delimiter = ';', $isSaved = false, $savePath = 'json/test.json')
    {
        if (!Storage::disk('local')->exists($csvPath)) {
            return [
                'process' => false,
                'message' => 'The file does not exist.',
                'data' => []
            ];
        }

        $csvContent = Storage::disk('local')->get($csvPath);
        $lines = explode("\n", $csvContent);
        $header = null;
        $data = [];

        foreach ($lines as $line) {
            $row = str_getcsv($line, $delimiter);

            if (!$header) {
                $header = $row;
            } else {
                if (count($row) == count($header)) {
                    $data[] = array_combine($header, $row);
                }
            }
        }

        if ($isSaved) {
            $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            Storage::disk('local')->put($savePath, $jsonData);
        }

        return [
            'process' => true,
            'message' => 'The file has been processed.',
            'data' => $data
        ];
    }

    public function mapearCSV(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $csvPath = 'roles/indiciativa/listado_especial.csv';
        $process = $this->generateJson($csvPath, ',');

        if (!$process['process']) {
            return ResponseApiController::error($process['message']);
        }

        $data = $process['data'];
        $dataRow = [];

        foreach ($data as $key => $item) {

            $dataRow = $item;

        }

        return ResponseApiController::success($dataRow);
    }

    public function mapear_coordinadores_academicos(Request $request)
    {
        try {
            set_time_limit(0);
            ini_set('memory_limit', '-1');

            $csvPath = 'roles/gestion_usuarios/integracion_coordinadores.csv';
            $process = $this->generateJson($csvPath, ',');

            if (!$process['process']) {
                return ResponseApiController::error($process['message']);
            }

            $data = $process['data'];
            $newCoordinators = [];

            foreach ($data as $key => $item) {

                $valueFirst = '';

                foreach ($item as $key => $value) {
                    $valueFirst = $value;
                    break;
                }

                $coordinatorDocType = match ($item['US_TIPO_DOC_ID_FK']) {
                    'CC' => 1,
                    'CE' => 4,
                    'TI' => 2,
                    'RC' => 3,
                    'PA' => 5,
                    default => 1,
                };

                $data = [
                    'us_num_doc' => $valueFirst,
                    'us_nombre_login' => $item['US_NOMBRE_LOGIN'],
                    'us_nombre' => $item['US_NOMBRE'],
                    'us_apellido' => $item['US_APELLIDO'],
                    'us_password' => $item['US_PASSWORD'],
                    'us_email_institucional' => $item['US_EMAIL_INSTITUCIONAL'],
                    'us_email_alternativo' => $item['US_EMAIL_ALTERNATIVO'],
                    'us_skpye' => $item['US_SKPYE'],
                    'us_telefono' => $item['US_TELEFONO'],
                    'us_estado' => 'ACTIVO',
                    'us_origen' => 'Intregración de coordinadores',
                    'us_ultima_integracion' => now(),
                    'us_estado_password' => null,
                    'us_tipo_vinculacion' => $item['US_TIPO_VINCULACION'],
                    'us_profesion' => $item['US_PROFESION'],
                    'us_contrato_inicio' => null,
                    'us_contrato_fin' => null,
                    'us_tipo_doc_id_fk' => $coordinatorDocType,
                    'us_cent_id_fk' => $item['US_CENT_ID_FK'],
                    'us_rol_institucional' => $item['US_ROL_INSTITUCIONAL'],
                    'us_image' => 'no_photo.jpg'
                ];


                $existingCoordinator = Usuarios::where('us_num_doc', $valueFirst)->first();

                if ($existingCoordinator) {
                    $data['us_password'] = EncryptionController::encrypt('SVP_' . $valueFirst . '*');
                    $existingCoordinator->update($data);
                    $processedCoordinators['updated'][] = $valueFirst;
                } else {
                    $data['us_password'] = EncryptionController::encrypt('SVP_' . $valueFirst . '*');
                    $newCoordinators[] = $data;
                    $processedCoordinators['created'][] = $valueFirst;
                }
            }

            if (!empty($newCoordinators)) {
                Usuarios::insert($newCoordinators);
            }

            return ResponseApiController::success($data);
        } catch (\Throwable $th) {
            return ResponseApiController::error([
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
        }
    }

    public function mapear_subdirectores_centro(Request $request)
    {
        try {
            set_time_limit(0);
            ini_set('memory_limit', '-1');

            $csvPath = 'roles/gestion_usuarios/gestion_usuarios.csv';
            $process = $this->generateJson($csvPath);

            if (!$process['process']) {
                return ResponseApiController::error($process['message']);
            }

            $data = $process['data'];
            $newCoordinators = [];

            foreach ($data as $key => $item) {

                $valueFirst = '';

                foreach ($item as $key => $value) {
                    $valueFirst = $value;
                    break;
                }

                $coordinatorDocType = match ($item['US_TIPO_DOC_ID_FK']) {
                    'CC' => 1,
                    'CE' => 4,
                    'TI' => 2,
                    'RC' => 3,
                    'PA' => 5,
                    default => 1,
                };

                $data = [
                    'us_num_doc' => $valueFirst,
                    'us_nombre_login' => $item['US_NOMBRE_LOGIN'],
                    'us_nombre' => $item['US_NOMBRE'],
                    'us_apellido' => $item['US_APELLIDO'],
                    'us_password' => $item['US_PASSWORD'],
                    'us_email_institucional' => $item['US_EMAIL_INSTITUCIONAL'],
                    'us_email_alternativo' => $item['US_EMAIL_ALTERNATIVO'],
                    'us_skpye' => $item['US_SKPYE'],
                    'us_telefono' => $item['US_TELEFONO'],
                    'us_estado' => 'ACTIVO',
                    'us_origen' => 'Intregración Subdirectores de Centro',
                    'us_ultima_integracion' => now(),
                    'us_estado_password' => null,
                    'us_tipo_vinculacion' => $item['US_TIPO_VINCULACION'],
                    'us_profesion' => $item['US_PROFESION'],
                    'us_contrato_inicio' => null,
                    'us_contrato_fin' => null,
                    'us_tipo_doc_id_fk' => $coordinatorDocType,
                    'us_cent_id_fk' => $item['US_CENT_ID_FK'],
                    'us_rol_institucional' => $item['us_rol_institucional'],
                    'us_image' => 'no_photo.jpg'
                ];


                $existingCoordinator = Usuarios::where('us_num_doc', $valueFirst)->first();

                if ($existingCoordinator) {
                    $data['us_password'] = EncryptionController::encrypt('SVP_' . $valueFirst . '*');
                    $existingCoordinator->update($data);
                    $processedCoordinators['updated'][] = $valueFirst;
                } else {
                    $data['us_password'] = EncryptionController::encrypt('SVP_' . $valueFirst . '*');
                    $newCoordinators[] = $data;
                    $processedCoordinators['created'][] = $valueFirst;
                }
            }

            if (!empty($newCoordinators)) {
                Usuarios::insert($newCoordinators);
            }

            return ResponseApiController::success($data);
        } catch (\Throwable $th) {
            return ResponseApiController::error([
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
        }
    }

    public function test_postman(Request $request)
    {
        $csvPath = '/roles/gestion_reportes/ejecucion_vs_metas/metas_cupos_pasan_2024.csv';
        // $csvPath = 'roles/gestion_reportes/registros_calificados/Base_registro_calificados_11122023.csv';

        $process = $this->generateJson($csvPath);

        if ($process['process']) {
            return ResponseApiController::success($process['data']);
        } else {
            return ResponseApiController::error($process['message']);
        }
    }

    public function test_registrosCalificados(Request $request)
    {

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        try {
            $csvPath = 'roles/gestion_reportes/registros_calificados/Base_registro_calificados_11122023.csv';

            $process = $this->generateJson($csvPath);

            if (!$process['process']) {
                return ResponseApiController::error($process['message']);
            }

            $data = $process['data'];

            foreach ($data as $item) {

                $valueFirst = '';
                foreach ($item as $key => $value) {
                    $valueFirst = $value;
                    break;
                }
            }

            return ResponseApiController::success($data);
        } catch (\Throwable $th) {
            return ResponseApiController::error($th->getMessage());
        }
    }

    public function test_monitoreo_fichas_red_conocimiento(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        try {
            $csvPath = 'roles/monitoreo_fichas/red_conocimiento/Validación_programas_línea_red.csv';

            $process = $this->generateJson($csvPath);

            if (!$process['process']) {
                return ResponseApiController::error($process['message']);
            }

            $data = $process['data'];

            foreach ($data as $item) {

                $valueFirst = '';
                foreach ($item as $key => $value) {
                    $valueFirst = $value;
                    break;
                }
            }

            return ResponseApiController::success($data);
        } catch (\Throwable $th) {
            return ResponseApiController::error($th->getMessage());
        }
    }

    public function test_monitoreo_fichas_registros_calificados(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        try {
            $csvPath = 'roles/monitoreo_fichas/registro_calificado/bd-rc-nacional-1703000751.csv';

            $process = $this->generateJson($csvPath);

            if (!$process['process']) {
                return ResponseApiController::error($process['message']);
            }

            $data = $process['data'];

            foreach ($data as $item) {

                $valueFirst = '';
                foreach ($item as $key => $value) {
                    $valueFirst = $value;
                    break;
                }
            }

            return ResponseApiController::success($data);
        } catch (\Throwable $th) {
            return ResponseApiController::error($th->getMessage());
        }
    }
    private function changeDate($date)
    {
        if (DateTime::createFromFormat('d/m/Y', $date) !== false) {
            $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }
        return $date;
    }
}
