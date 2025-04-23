<?php

namespace App\Http\Middleware;

use App\Models\Caja;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCajaAperturadaUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $existe = Caja::where('user_id', Auth::id())->where('estado', 1)->exists(); 

        if (!$existe) {
            return redirect()->route('cajas.index') // Redirige a otra ruta si no existe
                ->with('error', 'Debe aperturar una caja');
        }

        return $next($request);
    }
}
