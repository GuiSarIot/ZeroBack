<?php

namespace App\Http\Controllers\Emails;

//* controllers
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApiController;

//* services
use App\Http\Services\Emails\MailSendService;
use App\Jobs\EnviarCorreo;

//* libraries
use Illuminate\Http\Request;

class EnviarCorreoController extends Controller
{
    public function enviarNotificacion(Request $request)
    {
        $correo = $request->input('correo');
        $mensaje = $request->input('mensaje'); // Recibe el mensaje del request

        if (!$correo || !$mensaje) {
            return response()->json(['error' => 'Correo y mensaje son requeridos'], 400);
        }

        $datos = ['mensaje' => $mensaje];

        EnviarCorreo::dispatch($correo, $datos,'emails.casos.prueba');

        return response()->json(['message' => 'Correo en cola']);
    }
}
