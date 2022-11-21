<?php

require __DIR__ . '/../vendor/autoload.php';

use \App\Utils\View;
use \Dotenv\Dotenv;
use \WilliamCosta\DatabaseManager\Database;
use \App\Http\Middleware\Queue as MiddlewareQueue;

// CARREGA AS VARIÁVEIS DE AMBIENTE
Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

//CONFIG DATABASE CLASS
Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

// DEFINE CONSTANTE DE URL
define('URL', getenv('URL'));

// DEFINE O VALOR PADRÃO DAS VARIÁVEIS
View::init([
    'URL' => URL
]);

// DEFINE O MAPEAMENTO DE MIDDLEWARES
MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class
]);

// DEFINE O MAPEAMENTO DE MIDDLEWARES
MiddlewareQueue::setDefault([
    'maintenance'
]);