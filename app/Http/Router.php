<?php

namespace App\Http;

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
        $this->request = new Request();
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

}