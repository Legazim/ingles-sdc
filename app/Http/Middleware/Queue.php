<?php

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use \Closure;

class Queue
{

    /**
     * Mapeamento de middlewares
     */
    private static array $map;

    /**
     * Mapeamento de middlewares que serão carregados em todas as rotas
     */
    private static array $default;

    /**
     * Fila de middlewares a serem executados
     */
    private array $middlewares;

    /**
     * Função de exe
     */
    private Closure $controller;

    /**
     * Argumentos da função do controlador
     */
    private array $controllerArgs;

    /**
     * Método responsável por construir a classe de fila de middlewares
     */
    public function __construct(array $middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /**
     * Método responsável por executar o proximo nível da fila de middlewares
     */
    public function next(Request $request) : Response
    {
        // VERIFICA SE A FILA ESTÁ VAZIA
        if (empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        // MIDDLEWARE
        $middleware = array_shift($this->middlewares);

        // VERIFICA O MAPEAMENTO
        if (!isset(self::$map[$middleware])) {
            throw new \Exception('Problemas ao processar o middleware da requisição', 500);
        }

        // NEXT
        $queue = $this;
        $next = function($request) use($queue) {
            return $queue->next($request);
        };

        // EXECUTA O MIDDLEWARE
        return (new self::$map[$middleware])->handle($request, $next);
    }

	/**
	 * Define o mapeamento de middlewares
	 */
	static function setMap(array $map) {
		self::$map = $map;
	}

	/**
	 * Define o mapeamento de middlewares padrões
	 */
    static function setDefault(array $default) {
        self::$default = $default;
	}

}