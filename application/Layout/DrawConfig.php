<?php


namespace Layout;

use Core;

class DrawConfig
{

    protected const Config = [
        ## Mostrar componente 'not-found', caso o componente requisitado não seja encontrado
        "show_not_found" => true,
        "base_path" => CONFIG_GLOBAL['Layout']['components_path']

    ];

}