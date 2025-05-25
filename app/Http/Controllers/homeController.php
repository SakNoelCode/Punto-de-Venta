<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index(): View
    {
        if (!Auth::check()) {
            return view('welcome');
        }

        $totalVentasPorDia = DB::table('ventas')
            ->selectRaw('DATE(created_at) as fecha, SUM(total) as total')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('fecha', 'asc')
            ->get()->toArray();

        $productosStockBajo = DB::table('productos')
            ->join('inventario', 'productos.id', '=', 'inventario.producto_id')
            ->where('inventario.cantidad', '>', 0)
            ->orderBy('inventario.cantidad', 'asc')
            ->select('productos.nombre', 'inventario.cantidad')
            ->limit(5)
            ->get();


        return view('panel.index', compact('totalVentasPorDia','productosStockBajo'));
    }
}
