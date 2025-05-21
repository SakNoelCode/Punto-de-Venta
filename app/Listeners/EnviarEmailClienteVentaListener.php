<?php

namespace App\Listeners;

use App\Events\CreateVentaEvent;
use App\Jobs\EnviarComprobanteVentaJob;

class EnviarEmailClienteVentaListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(CreateVentaEvent $event): void
    {
        EnviarComprobanteVentaJob::dispatch($event->venta->id)->afterCommit();
    }
}
