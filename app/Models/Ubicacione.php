<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ubicacione extends Model
{
    protected $fillable = ['nombre'];
    
    public function inventario(): HasMany
    {
        return $this->hasMany(Inventario::class);
    }
}
