<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;

define('URL', 'http://localhost:5050');

// DEFINE O VALOR PADRÃO DAS VARIÁVEIS
View::init([
    'URL' => URL
]);

// INICIA O ROUTER
$obRouter = new Router(URL);

// INCLUI AS ROTAS DE PAGINAS
require __DIR__.'/routes/pages.php';

// IMPRIME AS RESPONSES DAS ROTAS
$obRouter->run()
         ->sendResponse();