<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class roleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-role|crear-role|editar-role|eliminar-role', ['only' => ['index']]);
        $this->middleware('permission:crear-role', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-role', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = Role::where('name', '!=', 'administrador')
            ->latest()
            ->get();

        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $permisos = Permission::all();
        return view('role.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        try {
            DB::beginTransaction();
            //Crear rol
            $rol = Role::create(['name' => $request->name]);
            //Asignar permisos
            $rol->syncPermissions(array_map(fn($value) => (int)$value, $request->permission));

            DB::commit();
            ActivityLogService::log('Creación de rol', 'Roles', $request->all());
            return redirect()->route('roles.index')->with('success', 'Rol registrado');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Error al crear el rol', ['error' => $e->getMessage()]);
            return redirect()->route('roles.index')->with('error', 'Ups, algo falló');
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
    public function edit(Role $role): View
    {
        $permisos = Permission::all();
        return view('role.edit', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permission' => 'required'
        ]);

        try {
            DB::beginTransaction();
            //Actualizar rol
            $role->update(['name' => $request->name]);
            //Actualizar permisos
            $role->syncPermissions(array_map(fn($value) => (int)$value, $request->permission));

            DB::commit();
            ActivityLogService::log('Edición de rol', 'Roles', $request->all());
            return redirect()->route('roles.index')->with('success', 'rol editado');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Error al editar el rol', ['error' => $e->getMessage()]);
            return redirect()->route('roles.index')->with('error', 'Ups, algo falló');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            Role::where('id', $id)->delete();

            ActivityLogService::log('Eliminación de rol', 'Roles', ['rol_id' => $id]);
            return redirect()->route('roles.index')->with('success', 'Rol eliminado');
        } catch (Throwable $e) {
            Log::error('Error al eliminar el rol', ['error' => $e->getMessage()]);
            return redirect()->route('roles.index')->with('error', 'Ups, algo falló');
        }
    }
}
