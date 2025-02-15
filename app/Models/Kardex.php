<?php

namespace App\Models;

use App\Enums\TipoTransaccionEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kardex extends Model
{
    protected $guarded = ['id'];

    protected $table = 'kardex';

    protected $casts = ['tipo_transaccion' => TipoTransaccionEnum::class];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Kardex::class);
    }

    public function crearRegistro(array $data, TipoTransaccionEnum $tipo): void
    {
        $this->create([
            'producto_id' => $data['producto_id'],
            'tipo_transaccion' => $tipo,
            'descripcion_transaccion' => $this->getDescripcionTransaccion($data, $tipo),
            'entrada' => null,
            'salida' => null,
            'saldo' => $data['cantidad'],
            'costo_unitario' => $data['costo_unitario'],
        ]);
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
        }

        return $descripcion;
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
}
