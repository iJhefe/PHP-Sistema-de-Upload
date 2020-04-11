<?php


namespace Hook;


use Core\Path;

class JSFile
{
    public function __construct(string $name)
    {
        $path = Path::get_real_path('{base}/src/javascript/' . $name);

        header('Content-Type: text/javascript');

        // Existe um arquivo .js ?
        if (file_exists($path . '.js')) {
            include $path . '.js';
        }
        // Existe um arquivo PHP -> JS ?
        else if (file_exists($path . '.js.php')) {
            include $path . '.js.php';
        }
        else {
            echo '/* Não encontrado */';
        }
    }
}