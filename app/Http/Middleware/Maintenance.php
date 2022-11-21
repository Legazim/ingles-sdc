<?php

namespace App\Http\Middleware;

use \App\Http\Request;
use \App\Http\Response;
use Closure;

class Maintenance
{

    /**
     * Método Responsável por executar o middleware
     */
    public function handle(Request $request, Closure $next) : Response
    {
        // VERIFICA ESTADO DE MANUTENÇÃO DA PÁGINA
        if(getenv('MAINTENANCE') == 'true') {
            throw new \Exception('Página em manutenção. Tente novamente mais tarde', 200);
        };

        // EXECUTA O PROXIMO MIDDLEWARE
        return $next($request);
    }

}