<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Compra extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function proveedore(): BelongsTo
    {
        return $this->belongsTo(Proveedore::class);
    }

    public function comprobante(): BelongsTo
    {
        return $this->belongsTo(Comprobante::class);
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class)
            ->withTimestamps()
            ->withPivot('cantidad', 'precio_compra', 'fecha_vencimiento');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
