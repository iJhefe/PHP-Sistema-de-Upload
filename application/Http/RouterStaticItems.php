<?php


namespace Http;

use Hook;

/**
 * Class RouterStaticItems
 * @package Http
 */
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

            ## Retira o tipo do arquivo da rota para evitar duplicação de diretório
            ## Sanitiza o nome para caso tenha .css ou .js
            $name = str_replace($type, '', self::sanitizeName($route) );

            self::generateStatic($name, $type);
        }
    }

    /**
     * @param string $route
     * @param string $type
     */
    protected static function generateStatic(string $route, string $type = '')
    {

        if (!empty($type)) {
            Hook\Item::static($route, $type);
        }

    }

    /**
     * @param string $name
     * @return string|string[]
     */
    protected static function sanitizeName(string $name) {
        if (strpos($name, '.css'))
            return str_replace('.css', '', $name);
        elseif (strpos($name, '.js'))
            return str_replace('.js', '', $name);
        else
            return $name;
    }
}