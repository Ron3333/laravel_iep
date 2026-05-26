<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserIsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificamos si hay sesión y si el rol es 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
             return $next($request); // Permite el paso
        }
        // Si no es admin, lo mandamos a la raíz con un mensaje (opcional)
             return redirect()->to('/');
        
    }
}
