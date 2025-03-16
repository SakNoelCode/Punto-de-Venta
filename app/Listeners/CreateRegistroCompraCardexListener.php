<?php

namespace App\Listeners;

use App\Enums\TipoTransaccionEnum;
use App\Events\CreateCompraDetalleEvent;
use App\Models\Kardex;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRegistroCompraCardexListener
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
        $kardex = new Kardex();
        $kardex->crearRegistro(
            [
                'producto_id' => $event->producto_id,
                'compra_id' => $event->compra->id,
                'cantidad' => $event->cantidad,
                'costo_unitario' => $event->precio_compra
            ],
            TipoTransaccionEnum::Compra
        );
    }
}
