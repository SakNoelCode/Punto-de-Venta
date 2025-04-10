<?php

namespace App\Models;

use App\Observers\CajaObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(CajaObserver::class)]
class Caja extends Model
{
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }

    /**
     * Obtener solo fecha de la apertura
     */
    public function getFechaAperturaAttribute(): string
    {
        return Carbon::parse($this->fecha_hora_apertura)->format('d-m-Y');
    }

    /**
     * Obtener solo hora de la apertura
     */
    public function getHoraAperturaAttribute(): string
    {
        return Carbon::parse($this->fecha_hora_apertura)->format('H:i');
    }

     /**
     * Obtener solo fecha del cierre
     */
    public function getFechaCierreAttribute(): string
    {
        return $this->fecha_hora_cierre
            ? Carbon::parse($this->fecha_hora_cierre)->format('d-m-Y')
            : '';
    }

    /**
     * Obtener solo hora del cierre
     */
    public function getHoraCierreAttribute(): string
    {

        return $this->fecha_hora_cierre
            ? Carbon::parse($this->fecha_hora_cierre)->format('H:i')
            : '';
    }
}
