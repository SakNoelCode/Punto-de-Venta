<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Empleado extends Model
{
    protected $guarded = ['id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Guarda la imagen en el servidor
     */
    public function handleUploadImage(UploadedFile $image, $img_path = null): string
    {
        if ($img_path) {
            $relative_path = str_replace('storage/', '', $img_path);

            if (Storage::disk('public')->exists($relative_path)) {
                Storage::disk('public')->delete($relative_path);
            }
        }

        $name = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = 'storage/' . $image->storeAs('empleados', $name);
        return $path;
    }
}
