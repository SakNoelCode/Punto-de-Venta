<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Caracteristica extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'estado'];

    public function categoria(): HasOne
    {
        return $this->hasOne(Categoria::class);
    }

    public function marca(): HasOne
    {
        return $this->hasOne(Marca::class);
    }

    public function presentacione(): HasOne
    {
        return $this->hasOne(Presentacione::class);
    }
}
