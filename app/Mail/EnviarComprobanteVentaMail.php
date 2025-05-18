<?php

namespace App\Mail;

use App\Models\Empresa;
use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarComprobanteVentaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Venta $venta) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Envio de Comprobante de Venta',
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.venta.enviar-comprobante',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $venta = $this->venta;
        $empresa = Empresa::first();

        $pdf = Pdf::loadView('pdf.comprobante-venta', [
            'venta' => $venta,
            'empresa' => $empresa
        ])->output();

        return [
            Attachment::fromData(fn() => $pdf)
                ->as('Comprobante_' . $venta->numero_comprobante . '.pdf')
                ->withMime('aplication/pdf')
        ];
    }
}
