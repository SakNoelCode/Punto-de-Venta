<?php

namespace App\Services;

use App\Models\Empresa;
use Illuminate\Support\Facades\Cache;

class EmpresaService
{
    /**
     * Obtener del cache el registro de la empresa
     */
    public function obtenerEmpresa(): Empresa
    {
        return Cache::remember('empresa', 3600, function () {
            return Empresa::first();
        });
    }

    /**
     * Limpiar la Cache de empresa
     */
    public function limpiarCacheEmpresa(): void
    {
        Cache::forget('empresa');
    }
}
