<?php

namespace App\Observers;

use App\Models\Caja;
use App\Models\Comprobante;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VentaObsever
{
    /**
     * Handle the Caja "creating" event.
     */
    public function creating(Venta $venta): void
    {
        $caja = Caja::where('user_id', Auth::id())->where('estado', 1)->first();
        $tipoComprobante = Comprobante::findOrFail($venta->comprobante_id)->nombre;

        $venta->user_id = Auth::id();
        $venta->caja_id = $caja->id;
        $venta->numero_comprobante = $venta->generarNumeroVenta($caja->id, $tipoComprobante);
        $venta->fecha_hora = Carbon::now()->toDateTimeString();
    }

    /**
     * Handle the Venta "created" event.
     */
    public function created(Venta $venta): void
    {
        //
    }

    /**
     * Handle the Venta "updated" event.
     */
    public function updated(Venta $venta): void
    {
        //
    }

    /**
     * Handle the Venta "deleted" event.
     */
    public function deleted(Venta $venta): void
    {
        //
    }

    /**
     * Handle the Venta "restored" event.
     */
    public function restored(Venta $venta): void
    {
        //
    }

    /**
     * Handle the Venta "force deleted" event.
     */
    public function forceDeleted(Venta $venta): void
    {
        //
    }
}
