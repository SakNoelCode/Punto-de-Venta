<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }

    protected $fillable = ['persona_id'];
}
