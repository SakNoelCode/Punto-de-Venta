<?php

namespace App\Listeners;

use App\Events\CreateVentaDetalleEvent;
use App\Models\Inventario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateInventarioVentaListener
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
    public function handle(CreateVentaDetalleEvent $event): void
    {
        //Actualizar el inventario del producto
        $registro = Inventario::where('producto_id', $event->producto_id)->first();

        $registro->update([
            'cantidad' => ($registro->cantidad - $event->cantidad)
        ]);
    }
}
