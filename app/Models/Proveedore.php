<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    use HasFactory;

    protected $fillable = ['persona_id'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function compras(){
        return $this->hasMany(Compra::class);
    }
}
