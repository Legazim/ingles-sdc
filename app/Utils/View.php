<?php

namespace App\Utils;

class View
{

    /**
     * Variáveis padrões da view
     */
    private static array $vars;

    /**
     * Método responsável por definir os dados iniciais da classe
     */
    public static function init(array $vars)
    {
        self::$vars = $vars;
    }

    /**
     * Método responsável por retornar o conteúdo de uma view
     */
    private static function getContentView(string $view): string
    {
        $file = __DIR__ . '/../../resources/view/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por retornar o conteúdo renderizado de uma view
     */
    public static function render(string $view, array $vars = []): string
    {
        // CONTEÚDO DA VIEW
        $contentView = self::getContentView($view);

        // MERGE DE VARIÁVEIS DA VIEW
        $vars = array_merge(self::$vars, $vars);

        // Chaves dos arrays
        $keys = array_keys($vars);
        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);

        return str_replace($keys, array_values($vars), $contentView);
    }

}