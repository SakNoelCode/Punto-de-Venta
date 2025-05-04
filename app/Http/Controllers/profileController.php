<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class profileController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-perfil', ['only' => ['index']]);
        $this->middleware('permission:editar-perfil', ['only' => ['update']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, User $profile): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $profile->id,
            'password' => 'nullable'
        ]);

        /*Comprobar el password y aplicar el Hash*/
        if (empty($request->password)) {
            $request = Arr::except($request, array('password'));
        } else {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        try {
            $profile->update($request->all());
            return redirect()->route('profile.index')->with('success', 'Cambios guardados');
        } catch (Throwable $e) {
            Log::error('Error al actualizar perfil', ['error' => $e->getMessage()]);
            return redirect()->route('profile.index')->with('error', 'Ups, algo fallo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
