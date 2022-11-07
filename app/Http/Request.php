<?php

namespace App\Http;

class Request
{

    /**
     * Instância de router
     */
    public readonly Router $router;

    /**
     * Método Http da requisição
     */
    public readonly string $httpMethod;

    /**
     * URI da página
     */
    private string $uri;

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

    public function __construct($router)
    {
        $this->router = $router;
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri();
    }

    /**
     * Método responsável por definir a URI
     */
    private function setUri()
    {
        // URI COMPLETA (COM GETS)
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';

        // REMOVE GETS DA URI
        $xUri = explode('?', $this->uri);
        $this->uri = $xUri[0];
    }

    /**
     * URI da página
     */
    function getUri(): string
    {
        return $this->uri;
    }
}