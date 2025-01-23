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

    /**
     * Guarda una imagen en el Storage
     */
    public function handleUploadImage($image): string
    {
        $file = $image;
        $name = time() . $file->getClientOriginalName();
        //$file->move(public_path() . '/img/productos/', $name);
        $file->storeAs('productos', $name);
        return $name;
    }
}
