<?php

namespace App\Observers;

use App\Models\Inventario;
use App\Models\Producto;

class InventarioObserver
{
    /**
     * Handle the Inventario "created" event.
     */
    public function created(Inventario $inventario): void
    {
        //
    }

    /**
     * Handle the Inventario "updated" event.
     */
    public function updated(Inventario $inventario): void
    {
        //
    }

    public function saved(Inventario $inventario): void
    {
        $producto = Producto::where('id',$inventario->producto_id)->first();
        $producto->update([
            'estado' => 1
        ]);
    }

    /**
     * Handle the Inventario "deleted" event.
     */
    public function deleted(Inventario $inventario): void
    {
        //
    }

    /**
     * Handle the Inventario "restored" event.
     */
    public function restored(Inventario $inventario): void
    {
        //
    }

    /**
     * Handle the Inventario "force deleted" event.
     */
    public function forceDeleted(Inventario $inventario): void
    {
        //
    }
}
