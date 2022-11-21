<?php

require __DIR__ . '/includes/app.php';

use \App\Http\Router;

// INICIA O ROUTER
$obRouter = new Router(URL);

// INCLUI AS ROTAS DE PAGINAS
require __DIR__ . '/routes/pages.php';

// IMPRIME AS RESPONSES DAS ROTAS
$obRouter->run()
         ->sendResponse();