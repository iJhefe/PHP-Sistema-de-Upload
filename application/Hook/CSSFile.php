<?php


namespace Hook;


use Core\Path;

class CSSFile
{

    public function __construct(string $name)
    {
        $path = Path::get_real_path('{base}/src/styles/' . $name);

        header('Content-Type: text/css');

        if (file_exists($path . '.css')) {
            include $path . '.css';
        }
        else if (file_exists($path . '.css.php')) {
            include $path . '.css.php';
        }
        else {
            echo '/* Não encontrado */';
        }
    }
}