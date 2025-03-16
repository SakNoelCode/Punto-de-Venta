<?php

namespace App\Listeners;

use App\Events\CreateCompraDetalleEvent;
use App\Models\Inventario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateInventarioCompraListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(CreateCompraDetalleEvent $event): void
    {
        $registro = Inventario::where('producto_id', $event->producto_id)->first();

        $registro->update([
            'cantidad' => ($registro->cantidad + $event->cantidad),
            'fecha_vencimiento' => $event->fecha_vencimiento
        ]);
    }
}
