<?php

namespace App\Controller\Pages;
use \App\Model\Entity\Exercise;
use \App\Utils\View;

class About extends Page
{
    /**
     * Método responsável por retornar o conteúdo (view) da nossa About
     */
    public static function getAbout() : string
    {
        $obExercise = new Exercise;

        // View da About
        $content =  View::render('pages/about', [
            'title' => $obExercise->title,
            'status' => $obExercise->status,
            'date' => $obExercise->date,
            'description' => 'A escola mais legal do mundo'
        ]);

        // Retorna a view da página
        return parent::getPage('About > SDC Language School', $content);
    }
}