<?php


namespace Http;


class Session
{
    public static function set(string $name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function get(string $name)
    {
        if (!isset($_SESSION[$name]))
            return false;

        return $_SESSION[$name];
    }
}