<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Empleado extends Model
{
    protected $guarded = ['id'];
    
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
