<?php


namespace Http;


class Helper
{
    public static function get_base_url() : string
    {
        $link = CONFIG_GLOBAL['Url']['https'] ? 'https://' : 'http://';

        $link .= CONFIG_GLOBAL['Url']['base'];

        return $link;
    }

    public static function get_current_url() : string
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");

        $link .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


        return $link;
    }
}