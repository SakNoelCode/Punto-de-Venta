<?php

namespace App\Listeners;

use App\Events\CreateVentaEvent;
use App\Mail\EnviarComprobanteVentaMail;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarEmailClienteVentaListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateVentaEvent $event): void
    {
        $cliente_email = $event->venta->cliente->persona->email;

        if (filter_var($cliente_email, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($cliente_email)
                    ->send((new EnviarComprobanteVentaMail($event->venta))->afterCommit());
            } catch (Exception $e) {
                Log::error("Error al enviar comprobante de venta: " . $e->getMessage());
            }
        }
    }
}
