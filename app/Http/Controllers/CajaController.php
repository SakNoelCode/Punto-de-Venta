<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Rules\CajaCerradaRule;
use App\Services\ActivityLogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cajas = Caja::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('caja.index', compact('cajas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('caja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'saldo_inicial' => ['required', 'numeric', 'min:1', new CajaCerradaRule]
        ]);
        try {
            $caja = Caja::create($request->all());
            ActivityLogService::log('Creación de caja', 'Cajas', ['caja' => $caja]);
            return redirect()->route('movimientos.index', ['caja_id' => $caja->id])->with('success', 'Caja aperturada');
        } catch (Throwable $e) {
            Log::error('Error al crear la caja', ['error' => $e->getMessage()]);
            return redirect()->route('cajas.index')->with('error', 'Ups, algo falló');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caja $caja): RedirectResponse
    {
        try {
            $caja->update(['estado' => 0]);
            ActivityLogService::log('Caja cerrada', 'Cajas', ['estado' => $caja->estado]);
            return redirect()->route('cajas.index')->with('success', 'Caja cerrada');
        } catch (Throwable $e) {
            Log::error('Error al cerrar la caja', ['error' => $e->getMessage()]);
            return redirect()->route('cajas.index')->with('error', 'Ups, algo falló');
        }
    }
}
