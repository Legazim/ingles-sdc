<?php

namespace App\Controller\Pages;

use \App\Http\Request;
use \App\Utils\View;
use \App\Model\Entity\Testimony;
use \WilliamCosta\DatabaseManager\Pagination;

class Testimonies extends Page
{
    /**
     * Método responsável por retornar o conteúdo (view) da página
     */
    public static function getTestimonies(Request $request) : string
    {

        // VIEW DA HOME
        $content =  View::render('pages/Testimonies', [
            'itens' => self::getTestimoniesItens($request, $obPagination),
            'pagination' => self::getPagination($request, $obPagination)
        ]);

        // RETORNA A VIEW DA PÁGINA
        return parent::getPage('HOME > SDC Language School', $content);
    }

    /**
     * Método responsável por cadastrar depoimento
     */
    public static function insertTestimony(Request $request) : string
    {
        // DADOS DO POST
        $postVars = $request->postVars;

        // INSTÂNCIA DE DEPOIMENTO
        $obTestimony = new Testimony;
        $obTestimony->name = $postVars['name'];
        $obTestimony->message = $postVars['message'];
        $obTestimony->cadastrar();

        // RETORNA A PÁGINA DE LISTAGEM DE DEPOIMENTOS
        return self::getTestimonies($request);
    }

    /**
     * Método responsável por obter a renderização dos itens de depoimentos para a página
     */
    private static function getTestimoniesItens(Request $request, &$obPagination): string
    {
        // DEPOIMENTOS
        $itens = '';

        // DEFINIR A QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = Testimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        // PAGINA ATUAL
        $queryParams = $request->queryParams;
        $paginaAtual = $queryParams['page'] ?? 1;

        // INSTÂNCIA DE PAGINAÇÃO
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 3);

        // RESULTADOS DA PÁGINA
        $results = Testimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

        // RENDERIZA O ITEM
        while ($obTestimony = $results->fetchObject(Testimony::class)) {
            $itens .=  View::render('pages/testimonies/item', [
                'name' => $obTestimony->nome,
                'message' => $obTestimony->mensagem,
                'date' => date('d/m/Y H:i', strtotime($obTestimony->data))
            ]);
        }

        // RETORNA ITENS DE DEPOIMENTOS
        return $itens;
    }


}