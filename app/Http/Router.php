<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;
use \App\Http\Middleware\Queue as MiddlewareQueue;

class Router
{

    /**
     * URL completa do projeto (raiz)
     */
    private string $url = '';

    /**
     * prefixo de todas as rotas
     */
    private string $prefix = 'ingles-sdc';

    /**
     * private índice de rotas
     */
    private array $routes;

    /**
     * Instância de request
     */
    private Request $request;

    /**
     * Método responsável por iniciar a classe
     */
    public function __construct($url)
    {
        $this->request = new Request($this);
        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * Método responsável por definir os prefixos das rotas
     */
    private function setPrefix()
    {
        // INFORMAÇÕES DA URL ATUAL
        $parseUrl = parse_url($this->url);

        // DEFINE O PREFIXO
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Método responsável por adicionar uma rota na classe
     */
    private function addRoute(string $method, string $route, array $params)
    {
        // VALIDAÇÃO DOS PARÂMETROS
        foreach($params as $key=>$value) {
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        // MIDDLEWARES DA ROTA
        $params['middlewares'] = $params['middlewares'] ?? [];

        // VARIÁVEIS DA ROTA
        $params['variables'] = [];

        // PADRÃO DE VALIDAÇÃO DAS VARIÁVEIS DAS ROTAS
        $patternVariable = '/{(.*?)}/';
        if(preg_match_all($patternVariable,$route,$matches)) {
           $route = preg_replace($patternVariable, '(.*?)',$route);
           $params['variables'] = $matches[1];
        }

        // PADRÃO DE VALIDAÇÃO DA URL
        $patternRoute = '/^'.str_replace('/','\/', $route).'$/';

        // ADD ROTA DENTRO DA CLASSE
        $this->routes[$patternRoute][$method] = $params;

    }

    /**
     * Método responsável por definir uma rota de GET
     */
    public function get(string $route, array $params = [])
    {
        $this->addRoute('GET', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de POST
     */
    public function post(string $route, array $params = [])
    {
        $this->addRoute('POST', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de PUT
     */
    public function put(string $route, array $params = [])
    {
        $this->addRoute('PUT', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de DELETE
     */
    public function delete(string $route, array $params = [])
    {
        $this->addRoute('DELETE', $route, $params);
    }

    /**
     * Método responsável por retornar a URI desconsiderando o prefixo
     */
    private function getUri() :string {
        // URI DA REQUEST
        $uri = $this->request->getUri();

        // FATIA A URI COM O PREFIXO
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        // RETORNA A URI SEM PREFIXO
        return end($xUri);
    }

    /**
     * Método responsável por retornar os dados da rota atual
     */
    private function getRoute() : array {
        // URI
        $uri = $this->getUri();

        // METHOD
        $httpMethod = $this->request->httpMethod;

        // VALIDA AS ROTAS
        foreach ($this->routes as $patternRoute => $methods) {
            // VERIFICA SE A URI BATE COM O PADRÃO
            if(preg_match($patternRoute, $uri, $matches)){
                // VERIFICA O MÉTODO
                if(isset($methods[$httpMethod])) {
                    //REMOVE A PRIMEIRA POSIÇÃO
                    unset($matches[0]);

                    // VARIÁVEIS PROCESSADAS
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    // RETORNO DE PARÂMETROS DA ROTA
                    return $methods[$httpMethod];
                }
            // MÉTODO NÃO PERMITIDO/DEFINIDO
            throw new Exception('Método não permitido', 405);
            }
        }
        // PÁGINA NÃO ENCONTRADA
        throw new Exception('URL não encontrada', 404);
    }

    /**
     * Método responsável por executar a rota atual
     */
    public function run() {
        try {
            // OBTÉM A ROTA ATUAL
            $route = $this->getRoute();

            // VERIFICA O CONTROLADOR
            if(!isset($route['controller'])) {
                throw new Exception('A URL não pode ser processada',500);
            }

            //ARGUMENTOS DA FUNÇÃO
            $args = [];

            // REFLECTION
            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }


            // RETORNA A EXECUÇÃO DA FILA DE MIDDLEWARES
            return (
                new MiddlewareQueue($route['middlewares'], $route['controller'], $args)
            )->next($this->request);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Método responsável por retornar a URL atual
     */
    public function getCurrentUrl()
    {
        return $this->url.$this->getUri();
    }

}