<?php

namespace App\Observers;

use App\Models\Caja;
use App\Models\Movimiento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CajaObserver
{
    /**
     * Handle the Caja "creating" event.
     */
    public function creating(Caja $caja): void
    {
        $caja->nombre = 'Caja de ' . Auth::user()->name;
        $caja->fecha_hora_apertura = Carbon::now()->toDateTimeString();
        $caja->user_id = Auth::id();
    }

    /**
     * Handle the Caja "created" event.
     */
    public function created(Caja $caja): void
    {
        //
    }

    /**
     * Handle the Caja "updated" event.
     */
    public function updated(Caja $caja): void
    {
        //
    }

    public function updating(Caja $caja): void
    {
        $movimientos = Movimiento::where('caja_id', $caja->id)
            ->selectRaw("
            SUM(CASE WHEN tipo = 'VENTA' THEN monto ELSE 0 END) AS total_venta,
            SUM(CASE WHEN tipo = 'RETIRO' THEN monto ELSE 0 END) AS total_retiro
            ")->first();

        $caja->fecha_hora_cierre = Carbon::now()->toDateTimeString();
        $caja->saldo_final = $caja->saldo_inicial + ($movimientos->total_venta ?? 0) - ($movimientos->total_retiro ?? 0);
    }

    /**
     * Handle the Caja "deleted" event.
     */
    public function deleted(Caja $caja): void
    {
        //
    }

    /**
     * Handle the Caja "restored" event.
     */
    public function restored(Caja $caja): void
    {
        //
    }

    /**
     * Handle the Caja "force deleted" event.
     */
    public function forceDeleted(Caja $caja): void
    {
        //
    }
}
