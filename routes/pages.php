<?php

use \App\Http\Response;
use \App\Controller\Pages;
use \App\Http\Request;

// ROTA HOME
$obRouter->get('/', [
    function()
    {
        return new Response(200, Pages\Home::getHome());
    }
]);

// ROTA SOBRE
$obRouter->get('/about', [
    function() {
        return new Response(200, Pages\About::getAbout());
    }
]);

// ROTA EXERCÍCIOS
$obRouter->get('/exercises', [
    function() {
        return new Response(200, Pages\Exercises::getExercises());
    }
]);

// ROTA DEPOIMENTOS
$obRouter->get('/testimonies', [
    function(Request $request) {
        return new Response(200, Pages\Testimonies::getTestimonies($request));
    }
]);


// ROTA DEPOIMENTOS (INSERT)
$obRouter->post('/testimonies', [
    function(Request $request) {
        return new Response(200, Pages\Testimonies::insertTestimony($request));
    }
]);

// // ROTA SOBRE
// $obRouter->get('/pagina/{idPagina}/{acao}', [
//     function($idPagina, $acao)
//     {
//         return new Response(200, 'Pagina ' . $idPagina . ' - ' . $acao);
//     }
// ]);