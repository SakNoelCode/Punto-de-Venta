<?php

namespace App\Models;

use App\Enums\MetodoPagoEnum;
use App\Observers\CompraObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\UploadedFile;

#[ObservedBy(CompraObserver::class)]
class Compra extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'metodo_pago' => MetodoPagoEnum::class
    ];

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

    /**
     * Guardar el archivo en el servidor.
     */
    public function handleUploadFile(UploadedFile $file): string
    {
        // Crear un nombre único
        $name = uniqid() . '.' . $file->getClientOriginalExtension();

        $path = 'storage/' . $file->storeAs('compras', $name);

        return $path;
    }
}
