<?php


namespace Hook;


use Core\Path;

class CSSFile
{

    public function __construct(string $name)
    {
        $path = Path::get_real_path('{base}/src/styles/' . $name . '.css');

        header('Content-Type: text/css');

        if (file_exists($path))
            include $path;
        else
            echo '/* Não encontrado */';
    }
}