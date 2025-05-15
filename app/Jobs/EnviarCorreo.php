<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailQueue;
use App\Mail\NotificacionCorreo;

class EnviarCorreo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $correo;
    public $datos;
    protected $template;

    public function __construct($correo, $datos, $template)
    {
        $this->correo = $correo;
        $this->datos = $datos;
        $this->template = $template ?? 'emails.casos.notificacion';
    }

    public function handle()
{
    $emailQueue = EmailQueue::create([
        'correo' => $this->correo,
        'mensaje' => $this->datos['mensaje'] ?? null,
        'estado' => 'pendiente',
        'fecha_envio' => now(),
    ]);

    try {
        if (EmailQueue::whereDate('fecha_envio', today())->where('estado', 'enviado')->count() < 50000) {
            Mail::to($this->correo)->send(new NotificacionCorreo($this->datos, $this->template));
            $emailQueue->update(['estado' => 'enviado']);
        } else {
            $this->release(3600); // Reintentar en 1 hora
        }
    } catch (\Exception $e) {
        $emailQueue->update(['estado' => 'fallido']);
        $this->release(3600); // Reintentar en 1 hora
    }
}
}
