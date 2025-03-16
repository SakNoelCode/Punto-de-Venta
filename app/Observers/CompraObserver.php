<?php

namespace App\Observers;

use App\Models\Compra;
use Illuminate\Support\Facades\Auth;

class CompraObserver
{
    public function creating(Compra $compra): void
    {
        //Para asignar el usuario Id, cuando se crea una compra
        $compra->user_id = Auth::id();
    }

    /**
     * Handle the Compra "created" event.
     */
    public function created(Compra $compra): void
    {
        //
    }

    /**
     * Handle the Compra "updated" event.
     */
    public function updated(Compra $compra): void
    {
        //
    }

    /**
     * Handle the Compra "deleted" event.
     */
    public function deleted(Compra $compra): void
    {
        //
    }

    /**
     * Handle the Compra "restored" event.
     */
    public function restored(Compra $compra): void
    {
        //
    }

    /**
     * Handle the Compra "force deleted" event.
     */
    public function forceDeleted(Compra $compra): void
    {
        //
    }
}
