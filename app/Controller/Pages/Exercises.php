<?php

namespace App\Controller\Pages;
use \App\Model\Entity\Exercise;
use \App\Utils\View;

class Exercises extends Page
{
    /**
     * Método responsável por retornar o conteúdo (view) da nossa home
     */
    public static function getExercises() : string
    {
        $obExercise = new Exercise;

        // View da home
        $content =  View::render('pages/exercises', [
            'description' => 'A escola mais legal do mundo'
        ]);

        // Retorna a view da página
        return parent::getPage('Exercises > SDC Language School', $content);
    }
}