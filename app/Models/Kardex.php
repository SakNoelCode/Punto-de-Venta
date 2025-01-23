<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kardex extends Model
{
    protected $guarded = ['id'];

    protected $table = 'kardex';

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Kardex::class);
    }
}
