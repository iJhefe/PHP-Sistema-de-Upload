<?php


namespace Http;

use Hook;

class RouterStaticItems extends Router
{

    public static function route() : void
    {

        if ( Request::is_obtained('item', 'GET') ) {

            $route = self::sanitize($_GET['item']);

            if (strpos($route, DS))
                $exploded = explode(DS, $route);
            else
                $exploded = explode('/', $route);

            $type = $exploded[0];

            ## Retira o tipo do arquivo para evitar duplicação de diretório
            $name = str_replace($type, '', $route);

            self::generateStatic($name, $type);
        }
    }

    protected static function generateStatic(string $route, string $type = '')
    {

        if (!empty($type)) {
            Hook\Item::static($route, $type);
        }

    }
}