<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Solicitud;

class SolicitudEstadoCambiado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $solicitud;

    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Su solicitud: ' . $this->solicitud->titulo . ' ha sido actualizada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->solicitud->estado == "Pendiente") {
            $this->solicitud->estado = "Rechazada";
        }
        return (new Content())->view('emails.solicitud-cambiada')->with(['estado' => $this->solicitud->estado]);
    }
    

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
