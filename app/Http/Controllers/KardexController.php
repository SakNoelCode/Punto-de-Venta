<?php

namespace App\Http\Controllers;

use App\Models\Kardex;
use App\Models\Producto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class KardexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $producto_id = $request->get('producto_id');
        $productos = Producto::latest()->get();

        $kardex = $producto_id
            ? Kardex::where('producto_id', $producto_id)->latest()->get()
            : collect();

        return view('kardex.index', compact('productos', 'kardex', 'producto_id'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
