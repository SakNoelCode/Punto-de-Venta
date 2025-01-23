<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presentacione extends Model
{
    use HasFactory;

    protected $fillable = ['caracteristica_id', 'sigla'];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }

    public function caracteristica(): BelongsTo
    {
        return $this->belongsTo(Caracteristica::class);
    }
}
