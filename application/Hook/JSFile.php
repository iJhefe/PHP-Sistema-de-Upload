<?php


namespace Hook;


use Core\Path;

class JSFile
{
    public function __construct(string $name)
    {
        $path = Path::get_real_path('{base}/src/javascript/' . $name . '.js');

        header('Content-Type: text/javascript');

        if (file_exists($path))
            include $path;
        else
            echo '/* Não encontrado */';
    }
}