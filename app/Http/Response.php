<?php

namespace App\Http;

class Response
{
    /**
     * Código do status HTTP
     */
    private readonly int $httpCode;

    /**
     * Cabeçalho do response
     */
    private array $headers;

    /**
     * Conteúdo que está sendo retornado
     */
    private string $contentType = 'text/html';

    /**
     * Conteúdo do response
     */
    private mixed $content;

    /**
     * Método responsável por iniciar a classe e definir os valores
     */
    public function __construct(int $httpCode, mixed $content, string $contentType = 'text/html')
    {
        $this->httpCode = $httpCode ?? 200;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    /**
     * Método responsável pos alterar o content type do response
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * Método responsável por adicionar um registro no cabeçalho de response
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Método responsável por enviar os headers para o navegador
     */
    private function sendHeaders()
    {
        //STATUS
        http_response_code($this->httpCode);

        // ENVIAR HEADERS
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    /**
     * Enviar resposta para o usuário
     */
    public function sendResponse()
    {
        // ENVIA OS HEADERS
        $this->sendHeaders();

        // IMPRIME O CONTEÚDO
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }

}