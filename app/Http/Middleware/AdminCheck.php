<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->user()->funcao != 'administrador') {
            return abort(403, "Acesso não autorizado, apenas Administradores do sistema");
        }
        return $next($request);
    }
}
