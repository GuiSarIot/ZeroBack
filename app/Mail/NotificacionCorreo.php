<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $template;

    public function __construct($datos,$template)
    {
        $this->datos = $datos;
        $this->template = $template;
    }

    public function build()
    {
        return $this->subject('Notificación')
                    ->view($this->template)
                    ->with($this->datos);
    }

}
