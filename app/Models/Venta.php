<?php

namespace App\Models;

use App\Observers\VentaObsever;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ObservedBy(VentaObsever::class)]
class Venta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function caja(): BelongsTo
    {
        return $this->belongsTo(Caja::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comprobante(): BelongsTo
    {
        return $this->belongsTo(Comprobante::class);
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class)
            ->withTimestamps()
            ->withPivot('cantidad', 'precio_venta');
    }

     /**
     * Obtener solo la fecha
     * @return string
     */
    public function getFechaAttribute(): string
    {
        return Carbon::parse($this->fecha_hora)->format('d-m-Y');
    }

    /**
     * Obtener solo la hora
     * @return string
     */
    public function getHoraAttribute(): string
    {
        return Carbon::parse($this->fecha_hora)->format('H:i');
    }


    /**
     * Generar el número de venta
     */
    public function generarNumeroVenta(int $cajaId, string $tipoComprobante): string
    {
        // Determinar el prefijo según el tipo de comprobante
        $prefijo = strtoupper(substr($tipoComprobante, 0, 1)); // "B" para Boleta, "F" para Factura

        // Obtener la última venta de la caja
        $ultimaVenta = Venta::where('caja_id', $cajaId)
            ->latest('id') // Ordenar por la más reciente
            ->first();

        // Extraer la parte numérica del número de venta o comenzar desde 1
        $ultimoNumero = $ultimaVenta
            ? (int) substr($ultimaVenta->numero_comprobante, 7) // "0000001" -> 1
            : 0;

        // Incrementar el número
        $nuevoNumero = $ultimoNumero + 1;

        // Formatear el número de venta
        $numeroVenta = sprintf("%s%03d - %07d", $prefijo, $cajaId, $nuevoNumero);

        return $numeroVenta;
    }
}
