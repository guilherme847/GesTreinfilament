<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsColaborador
{
    /**
     * Handle an incoming request.
     * RN04: Restringe acesso ao painel do colaborador apenas para colaboradores
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->tipo !== 'colaborador') {
            abort(403, 'Acesso negado. Esta área é exclusiva para colaboradores.');
        }

        return $next($request);
    }
}

