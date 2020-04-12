<?php


namespace Layout;

use Http\Router;

class Get
{

    /**
     * @return string
     */
    public static function current_page() : string
    {
        $currentItem = Router::current_route()['Item'];

        if (strpos($currentItem, DS)) {

            $exploded = explode(DS, $currentItem);

            // Retorna o último item do explode, o que seria a página atual.
            return $exploded[ count($exploded) -1 ];
        }

        return $currentItem;
    }

}