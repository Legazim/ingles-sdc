<?php

namespace App\Controller\Pages;
use \App\Utils\View;

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