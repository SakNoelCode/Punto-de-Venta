<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function compras(): BelongsToMany
    {
        return $this->belongsToMany(Compra::class)
            ->withTimestamps()
            ->withPivot('cantidad', 'precio_compra', 'fecha_vencimiento');
    }

    public function ventas(): BelongsToMany
    {
        return $this->belongsToMany(Venta::class)
            ->withTimestamps()
            ->withPivot('cantidad', 'precio_venta');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    public function presentacione(): BelongsTo
    {
        return $this->belongsTo(Presentacione::class);
    }

    public function inventario(): HasOne
    {
        return $this->hasOne(Inventario::class);
    }

    public function kardex(): HasMany
    {
        return $this->hasMany(Kardex::class);
    }

    protected static function booted()
    {
        static::creating(function ($producto) {
            //Si no se propociona un código, generar uno único
            if (empty($producto->codigo)) {
                $producto->codigo = self::generateUniqueCode();
            }
        });
    }

    /**
     * Genera un código único para el producto
     */
    private static function generateUniqueCode(): string
    {
        do {
            $code = str_pad(random_int(0, 9999999999), 12, '0', STR_PAD_LEFT);
        } while (self::where('codigo', $code)->exists());

        return $code;
    }

    /**
     * Accesor para obtener el código, nombre y presentación del producto
     */
    public function getNombreCompletoAttribute(): string
    {
        return "Código: {$this->codigo} - {$this->nombre} - Presentación: {$this->presentacione->sigla}";
    }
}
