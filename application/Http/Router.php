<?php


namespace Http;

use Hook;

class Router
{

    public static function route() : void
    {
        $cr = self::current_route();

        Hook\Page::get($cr['Module'], $cr['Item']);
    }

    public static function current_route() : array
    {

        if ( Request::is_obtained('page', 'GET') )
        {

            $route = self::sanitize($_GET['page']);

            $route = self::generate($route);

            return ["Module" => $route[0], "Item" => $route[1]];

        }
        else
        {
            return ["Module" => '', "Item" => 'index'];
        }

    }

    protected static function generate(string $route, bool $isStatic = false, string $staticType = '') : array
    {

        $dirs = explode('/', $route);

        $Modules = Hook\Page::get_available_pages();

        if (count($dirs) == 1)
        {
            ## Se for um módulo, ele inicia a index do modulo.

            if ( isset( $Modules[ $dirs[0] ] ) )
                return [$dirs[0], 'index'];

            ## Se for um endpoint em subdiretorio e sem arquivo especifico, acessa a index do arquivo.

            return [ '', $dirs[0] . '/index' ];

        }



        $Item = '';

        $items_count = count($dirs) - 1;

        $Endpoint = $dirs[0];

        for ($i = 1; $i < $items_count; $i++):

            $Item .= $dirs[$i] . ( $i == $items_count ? '' : '/');

        endfor;

        $Item .= $dirs[ $items_count ];


        ## Se o endpoint não for modulo, ele vai para o default

        if ( !isset($Modules[$Endpoint]) )
        {
            $Item = $Endpoint . DS . $Item;
            $Endpoint = '';
        }

        return [ $Endpoint, $Item ];

    }

    protected static function sanitize(string $route) : string
    {
        return filter_var($route, FILTER_SANITIZE_STRING);
    }

}