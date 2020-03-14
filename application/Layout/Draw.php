<?php


namespace Layout;


class Draw
{

    public static function component(string $name) : DrawStaticComponent
    {
        return new DrawStaticComponent($name);
    }

    public static function static_url(string $name, string $type, bool $devMode = false) : string
    {

        $end = $devMode ? '?' . time() : '';
        $url = baseUrl . '/static/';

        $url .= $type . '/' . $name . '.' . $type . $end;

        if ($type === 'js')
            return "<script src=\"$url\"></script>";
        else if ($type === 'css')
            return "<link href=\"$url\" rel=\"stylesheet\">";

        return '<!-- Não encontrado: ' . $name . '-->';
    }
}