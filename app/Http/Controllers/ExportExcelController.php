<?php

namespace App\Http\Controllers;

use App\Jobs\DownloadExcelVentasAllJob;
use Illuminate\Http\RedirectResponse;

class ExportExcelController extends Controller
{
    /**
     * Exportar en EXCEL todas las ventas
     */
    public function exportExcelVentasAll(): RedirectResponse
    {
        $filename = 'ventas_' . now()->format('Y_m_d_His') . '.xlsx';
        DownloadExcelVentasAllJob::dispatch($filename);

        return redirect()->route('ventas.index')->with('success', 'Procesando descarga');
    }
}
