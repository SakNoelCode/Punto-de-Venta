<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimiento extends Model
{
    protected $guarded = ['id'];
    
    public function caja(): BelongsTo
    {
        return $this->belongsTo(Caja::class);
    }
}
