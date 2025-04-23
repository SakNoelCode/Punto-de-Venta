<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckShowVentaUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $venta = $request->route('venta');

        if ($venta->user_id != Auth::id()) {
            return redirect()->route('ventas.index') // Redirige a otra ruta si no existe
                ->with('error', 'No es posible acceder');
        }

        return $next($request);
    }
}
