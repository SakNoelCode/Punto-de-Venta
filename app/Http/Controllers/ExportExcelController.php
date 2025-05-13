<?php

namespace App\Http\Controllers;

use App\Exports\VentasExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportExcelController extends Controller
{
    /**
     * Exportar en EXCEL todas las ventas
     */
    public function exportExcelVentasAll(): BinaryFileResponse
    {
        return Excel::download(new VentasExport, 'ventas.xlsx');
    }
}
