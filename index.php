<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Controller\Pages\Home;

define('URL', 'http://localhost/ingles-sdc');

$obRouter = new Router(URL);

echo "<pre>";
print_r($obRouter);
echo "</pre>";

echo Home::getHome();