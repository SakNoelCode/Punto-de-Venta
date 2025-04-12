<?php

namespace App\Http\Middleware;

use App\Models\Caja;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMovimientoCajaUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $caja = Caja::findOrfail($request->caja_id);
        if ($caja->user_id != Auth::id()) {
            return redirect()->route('cajas.index')
                ->with('error', 'No es posible acceder');
        }
        return $next($request);
    }
}
