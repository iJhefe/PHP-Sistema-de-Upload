<?php


namespace Hook;

use Core\Path;

class Page
{

    public static function get(string $name, $item) : void
    {
        $path = Path::get_real_path('{base}/public/' . $name . '/' . $item . '.php');

        if (file_exists($path)) {

            include $path;
        }
        else {
            $not_found = Path::get_real_path('{base}/public/not-found.php');

            include $not_found;
        }

    }

    public static function get_available_pages() : array
    {
        $files = [];

        $path = CONFIG_GLOBAL['Core']['page_path'];

        if ( is_dir($path)) {

            $mainDir = scandir($path);

            ## Remove os itens de root, como: . e ..
            unset($mainDir[0]);
            unset($mainDir[1]);

            ## Por deletar os 2 primeiros indices, o laço começa do 2

            foreach ($mainDir as $key => $value):

                ## Se o indice for relativo a um diretório, colocar ele como indice na array e pegar seus arquivos

                $currPath = $path . DS . $value;

                if (is_dir($currPath)) {

                    $currDir = scandir($currPath);

                    ## Remove os itens de root, como: . e ..
                    unset($currDir[0]);
                    unset($currDir[1]);

                    foreach ($currDir as $dir):
                        ## Cria um indice com o nome da pasta e coloca seus arquivos dentro
                        $files[$value] = $dir;
                    endforeach;
                }
                else {
                    $files[] = $value;
                }

            endforeach;
        }

        return $files;
    }

}