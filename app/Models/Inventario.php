<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventario extends Model
{
    protected $guarded = ['id'];

    protected $table = 'inventario';

    public function ubicacione(): BelongsTo
    {
        return $this->belongsTo(Ubicacione::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
