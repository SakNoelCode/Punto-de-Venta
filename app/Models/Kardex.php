<?php

namespace App\Models;

use App\Enums\TipoTransaccionEnum;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class Kardex extends Model
{
    protected $guarded = ['id'];

    protected $table = 'kardex';

    protected $casts = ['tipo_transaccion' => TipoTransaccionEnum::class];

    private const MARGEN_GANANCIA = 0.2;

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Kardex::class);
    }

    public function getFechaAttribute(): string
    {
        return $this->created_at->format('d/m/Y');
    }

    public function getHoraAttribute(): string
    {
        return $this->created_at->format('h:i A');
    }

    public function getCostoTotalAttribute(): float
    {
        return $this->saldo * $this->costo_unitario;
    }

    /**
     * Crear un registro en el Kardex
     */
    public function crearRegistro(array $data, TipoTransaccionEnum $tipo): void
    {
        $entrada = null;
        $salida = null;
        $saldo = null;

        $ultimoRegistro = $this->where('producto_id', $data['producto_id'])
            ->latest('id')
            ->first();

        $saldo = $ultimoRegistro ? $ultimoRegistro->saldo : $data['cantidad'];

        if ($tipo == TipoTransaccionEnum::Compra) {
            $entrada = $data['cantidad'];
            $saldo += $entrada;
        } elseif ($tipo == TipoTransaccionEnum::Venta || $tipo == TipoTransaccionEnum::Ajuste) {
            $salida = $data['cantidad'];
            $saldo -= $salida;
        }

        try {
            $this->create([
                'producto_id' => $data['producto_id'],
                'tipo_transaccion' => $tipo,
                'descripcion_transaccion' => $this->getDescripcionTransaccion($data, $tipo),
                'entrada' => $entrada,
                'salida' => $salida,
                'saldo' => $saldo,
                'costo_unitario' => $data['costo_unitario'],
            ]);
        } catch (Exception $e) {
            Log::error('Error al crear un registro en el cardex', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Obtener la descripción según el tipo de Transacción
     */
    private function getDescripcionTransaccion(array $data, TipoTransaccionEnum $tipo): string
    {
        $descripcion = '';
        switch ($tipo) {
            case TipoTransaccionEnum::Apertura:
                $descripcion = 'Apertura del producto';
                break;
            case TipoTransaccionEnum::Compra:
                $descripcion = 'Entrada de producto por la compra n°' . $data['compra_id'];
                break;
            case TipoTransaccionEnum::Venta:
                $descripcion = 'Salida de producto por la venta n°' . $data['venta_id'];
                break;
            case TipoTransaccionEnum::Ajuste:
                $descripcion = 'Ajuste de producto';
                break;
        }

        return $descripcion;
    }

    /**
     * Obtener el precio de Venta según el costo del Producto
     */
    public function calcularPrecioVenta(int $producto_id): float
    {
        $costoUltimoRegistro = $this->where('producto_id', $producto_id)
            ->latest('id')
            ->first()
            ->costo_unitario;

        return $costoUltimoRegistro + round($costoUltimoRegistro * self::MARGEN_GANANCIA, 2);
    }
}
