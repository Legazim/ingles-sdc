<?php

namespace App\Model\Entity;

use PDOStatement;
use \WilliamCosta\DatabaseManager\Database;

class Testimony
{

    /**
     * ID do depoimento
     */
    public int $id;

    /**
     * Nome de usuário que postou o depoimento
     */
    public string $name;

    /**
     * Mensagem do depoimento
     */
    public string $message;

    /**
     * Data de publicação do depoimento
     */
    public string $date;

    /**
     * Método que cadastra a instância atual noi banco de dados
     */
    public function cadastrar() : bool
    {
        // DEFINE A DATA
        $this->date = date('Y-m-d H:i:s');

        // INSERE O DEPOIMENTO NO BANCO DE DADOS
        $this->id = (new Database('depoimentos'))->insert([
            'nome' => $this->name,
            'mensagem' => $this->message,
            'data' => $this->date
        ]);

        // RETORNA SUCCESSO
        return true;
    }

    public static function getTestimonies(string $where = null, string $order = null, string $limit = null, string $fields = '*')
    {
        return (new Database('depoimentos'))->select($where, $order, $limit, $fields);
    }

}