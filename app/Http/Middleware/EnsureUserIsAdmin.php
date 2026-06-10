<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Bloquea el acceso a usuarios autenticados que no tengan rol "admin".
     * Se usa junto al middleware 'auth' (alias 'admin' registrado en bootstrap/app.php).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()?->rol?->nombre !== 'admin') {
            abort(403, 'Acceso denegado.');
        }

        return $next($request);
    }
}
