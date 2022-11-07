<?php

namespace App\Controller\Pages;
use \App\Utils\View;
use \App\Http\Request;
use \WilliamCosta\DatabaseManager\Pagination;

class Page
{
    private static function getHeader(): string
    {
        return View::render('pages/header');
    }

    private static function getFooter(): string
    {
        return View::render('pages/footer');
    }

    /**
     * Método responsável por renderizar o layout de paginação
     */
    public static function getPagination(Request $request, Pagination $obPagination)
    {
        // PÁGINAS
        $pages = $obPagination->getPages();

        // VERIFICA O NÚMERO DE PÁGINAS
        if(count($pages) <= 1) return '';

        // LINKS
        $links = '';

        // URL ATUAL (SEM GETS)
        $url = $request->router->getCurrentUrl();

        // GET
        $queryParams = $request->queryParams;

        // RENDERIZA OS LINKS
        foreach($pages as $page) {

            // ALTERA A PÁGINA
            $queryParams['page'] = $page['page'];

            // LINK
            $link = $url . '?' . http_build_query($queryParams);

            // VIEW
            $links .= View::render('pages/pagination/link', [
                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : ''
            ]);
        }

        // RENDERIZA BOX DE PAGINAÇÃO
        return View::render('pages/pagination/box', [
            'links' => $links
        ]);
    }

    /**
     * Método responsável por retornar o conteúdo (view) da nossa home
     */
    public static function getPage($title, $content) : string
    {
        return View::render('pages/page', [
            'header' =>self::getHeader(),
            'title'=> $title,
            'content' => $content,
            'footer' => self::getFooter(),
        ]);
    }
}