<?php

namespace App\Http;

class Request
{

    /**
     * Método Http da requisição
     */
    public readonly string $httpMethod;

    /**
     * URI da página
     */
    public readonly string $uri;

    /**
     * Parâmetros da URL ($_GET)
     */
    public readonly array $queryParams;

    /**
     * Variáveis recebidas no POST da página ($_POST)
     */
    public readonly array $postVars;

    /**
     * Cabeçalho da requisição
     */
    public readonly array $headers;

    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }

}