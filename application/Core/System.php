<?php


namespace Core;

use Http;

class System
{

    public static function start() : void
    {
        self::set_constants();
    }

    private static function set_constants() : void
    {
        if (!defined('baseUrl'))
            define('baseUrl', Http\Helper::get_base_url());
    }

}