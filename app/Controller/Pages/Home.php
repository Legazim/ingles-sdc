<?php

namespace App\Controller\Pages;
use App\Model\Entity\Exercise;
use \App\Utils\View;

class Home extends Page
{
    /**
     * Método responsável por retornar o conteúdo (view) da nossa home
     * @return string
     */
    public static function getHome()
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
        return parent::getPage('SDC Language school', $content);
    }
}