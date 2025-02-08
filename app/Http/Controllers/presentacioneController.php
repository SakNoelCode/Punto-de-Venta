<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\UpdatePresentacioneRequest;
use App\Models\Caracteristica;
use App\Models\Presentacione;
use App\Services\ActivityLogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class presentacioneController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-presentacione|crear-presentacione|editar-presentacione|eliminar-presentacione', ['only' => ['index']]);
        $this->middleware('permission:crear-presentacione', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-presentacione', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-presentacione', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get();
        return view('presentacione.index', compact('presentaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('presentacione.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaracteristicaRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->presentacione()->create(['sigla' => $request->sigla]);
            DB::commit();
            ActivityLogService::log('Creación de presentación', 'Presentaciones', $request->validated());

            return redirect()->route('presentaciones.index')->with('success', 'Presentación registrada');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Error al crear la presentacion", ['error' => $e->getMessage()]);
            return redirect()->route('presentaciones.index')->with('error', 'Ups algo falló');
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
    public function edit(Presentacione $presentacione): View
    {
        return view('presentacione.edit', compact('presentacione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentacioneRequest $request, Presentacione $presentacione): RedirectResponse
    {
        try {
            $presentacione->caracteristica->update($request->validated());
            $presentacione->update($request->validated());

            ActivityLogService::log('Edición de presentación', 'Presentaciones', $request->validated());

            return redirect()->route('presentaciones.index')->with('success', 'Presentación editada');
        } catch (Throwable $e) {
            Log::error("Error al editar la presentacion", ['error' => $e->getMessage()]);

            return redirect()->route('presentaciones.index')->with('error', 'Ups, algo falló');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $presentacione = Presentacione::find($id);

            $nuevoEstado = $presentacione->caracteristica->estado == 1 ? 0 : 1;
            $presentacione->caracteristica->update(['estado' => $nuevoEstado]);
            $message = $nuevoEstado == 1 ? 'Presentación restaurado' : 'Presentación eliminada';

            ActivityLogService::log($message, 'Presentaciones', [
                'presentacione_id' => $id,
                'estado' => $nuevoEstado
            ]);

            return redirect()->route('presentaciones.index')->with('success', $message);
        } catch (Throwable $e) {

            Log::error('Error al eliminar/restaurar la presentación', ['error' => $e->getMessage()]);

            return redirect()->route('presentaciones.index')->with('error', 'Ups, algo falló');
        }
    }
}
