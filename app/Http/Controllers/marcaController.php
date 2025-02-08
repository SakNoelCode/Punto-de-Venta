<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\Caracteristica;
use App\Models\Marca;
use App\Services\ActivityLogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class marcaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-marca|crear-marca|editar-marca|eliminar-marca', ['only' => ['index']]);
        $this->middleware('permission:crear-marca', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-marca', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-marca', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $marcas = Marca::with('caracteristica')->latest()->get();
        return view('marca.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaracteristicaRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->marca()->create([]);
            DB::commit();

            ActivityLogService::log('Creación de marca', 'Marcas', $request->validated());
            return redirect()->route('marcas.index')->with('success', 'Marca registrada');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Error al crear la marca", ['error' => $e->getMessage()]);
            return redirect()->route('marcas.index')->with('error', 'Ups, algo falló');
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
    public function edit(Marca $marca): View
    {
        return view('marca.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarcaRequest $request, Marca $marca): RedirectResponse
    {
        try {
            $marca->caracteristica->update($request->validated());

            ActivityLogService::log('Edición de marca', 'Marcas', $request->validated());

            return redirect()->route('marcas.index')->with('success', 'Marca editada');
        } catch (Throwable $e) {
            Log::error("Error al editar la marca", ['error' => $e->getMessage()]);

            return redirect()->route('marcas.index')->with('error', 'Ups, algo falló');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $marca = Marca::find($id);

            $nuevoEstado = $marca->caracteristica->estado == 1 ? 0 : 1;
            $marca->caracteristica->update(['estado' => $nuevoEstado]);
            $message = $nuevoEstado == 1 ? 'Marca restaurada' : 'Marca eliminada';

            ActivityLogService::log($message, 'Marcas', [
                'marca_id' => $id,
                'estado' => $nuevoEstado
            ]);

            return redirect()->route('marcas.index')->with('success', $message);
        } catch (Throwable $e) {

            Log::error('Error al eliminar/restaurar la marca', ['error' => $e->getMessage()]);

            return redirect()->route('marcas.index')->with('error', 'Ups, algo falló');
        }
    }
}
