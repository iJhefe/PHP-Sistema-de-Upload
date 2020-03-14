<?php


namespace Core;


class Path
{
    static function get_real_path(string $path) : string
    {

        // Primeiramente substituir a base do diretório

        $real_path = str_replace('{base}', CONFIG_GLOBAL['Core']['base_dir'], $path);

        // Substituir barras por DIRECTORY SEPARATOR, para evitar problemas

        $real_path = str_replace('/', DS, $real_path);

        return $real_path;

    }
}