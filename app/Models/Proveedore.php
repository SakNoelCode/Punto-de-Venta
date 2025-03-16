<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedore extends Model
{
    use HasFactory;

    protected $fillable = ['persona_id'];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class);
    }

    /**
     * Obtener la razon social, tipo y número de documento del proveedor
     */
    public function getNombreDocumentoAttribute(): string
    {
        return $this->persona->razon_social . ' - ' . $this->persona->documento->nombre . ': ' . $this->persona->numero_documento;
    }
}
