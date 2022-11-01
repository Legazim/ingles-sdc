<?php

namespace App\Controller\Pages;
use \App\Model\Entity\Exercise;
use \App\Utils\View;

class Home extends Page
{
    /**
     * Método responsável por retornar o conteúdo (view) da nossa home
     */
    public static function getHome() : string
    {
        $obExercise = new Exercise;

        // View da home
        $content =  View::render('pages/Home', [
            'title' => $obExercise->title,
            'status' => $obExercise->status,
            'date' => $obExercise->date,
            'description' => 'A escola mais legal do mundo'
        ]);

        // Retorna a view da página
        return parent::getPage('HOME > SDC Language School', $content);
    }
}