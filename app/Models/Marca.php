<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    public function productos(){
        return $this->hasMany(Producto::class);
    }

    public function caracteristica(){
        return $this->belongsTo(Caracteristica::class);
    }

    protected $fillable = ['caracteristica_id'];
}
