<?php

//* controllers
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApiController;

//* models
use App\Models\Historial_ingreso_modulo;
use App\Models\Usuarios;
use App\Models\Roles;

//* libraries
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitCountController extends Controller
{
    
    //* API - VisitCount register visit
    public function registerVisit(Request $request)
    {
        try {
            $id = $request->route('id');

            if ($id == '') {
                return ResponseApiController::error('ID no encontrado', 404);
            }

            //* if request has data
            if (!$request->has('rolName') || !$request->has('moduleName')) {
                return ResponseApiController::error('Faltan datos', 400);
            }

            $user = Usuarios::find($id);

            if ($user == '') {
                return ResponseApiController::error('Usuario no encontrado', 404);
            }

            $rol = Roles::select()->where('rol_nombre', '=', $request->rolName)->get()->first();

            if ($rol == '') {
                return ResponseApiController::error('Rol no encontrado', 404);
            }

            
            $lastVisit = Historial_ingreso_modulo::select()
            ->where('him_us_id', '=', $id)
            ->where('him_rol_id', '=', $rol->rol_id)
            ->where('him_mod_name', '=', $request->moduleName)
            ->orderBy('id', 'desc')
            ->get()->first();
            
            if ($lastVisit == '') {
                $visit = new Historial_ingreso_modulo();
                $visit->him_us_id = $id;
                $visit->him_rol_id = $rol->rol_id;
                $visit->him_mod_name = $request->moduleName;
                $visit->save();

                return ResponseApiController::success($visit, 200, 'Visita registrada');
            }

            //* set format date : Y-m-d H:i
            $dateLastVisit = date('Y-m-d H:i', strtotime($lastVisit->fecha_ing));
            $currentDate = date('Y-m-d H:i', strtotime(DB::select('SELECT NOW() as fecha')[0]->fecha));

            if ($dateLastVisit == $currentDate) {
                return ResponseApiController::success('Visita ya registrada', 200);
            }

            $visit = new Historial_ingreso_modulo();
            $visit->him_us_id = $id;
            $visit->him_rol_id = $rol->rol_id;
            $visit->him_mod_name = $request->moduleName;
            $visit->save();

            return ResponseApiController::success($visit, 200, 'Visita registrada');
        } catch (\Throwable $th) {
            return ResponseApiController::error([
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            
            ], 500);
        }
    }
}
