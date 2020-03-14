<?php


namespace Http;


class Request
{
    public static function is_obtained(string $name, string $method = 'GET') : bool
    {

        if (strtoupper($method) == 'POST')
            $req = $_POST;
        else
            $req = $_GET;


        if (isset( $req[$name] ) )
            return true;


        return false;

    }

    public static function get_header($name = '')
    {
        if (!empty($name))
            return ( isset(getallheaders()[$name]) ? getallheaders()[$name] : false);

        return getallheaders();
    }
}