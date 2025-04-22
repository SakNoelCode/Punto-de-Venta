<?php

namespace App\Listeners;

use App\Enums\TipoTransaccionEnum;
use App\Events\CreateVentaDetalleEvent;
use App\Models\Kardex;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRegistroVentaCardexListener
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
        //Crear un nuevo registro en mi tabla Kardex, pero de tipo venta
        $kardex = new Kardex();

        $costoUnitario = $kardex->where('producto_id', $event->producto_id)
            ->latest('id')
            ->first()
            ->costo_unitario;

        $kardex->crearRegistro(
            [
                'venta_id' => $event->venta->id,
                'producto_id' => $event->producto_id,
                'cantidad' => $event->cantidad,
                'costo_unitario' => $costoUnitario
            ],
            TipoTransaccionEnum::Venta
        );
    }
}
