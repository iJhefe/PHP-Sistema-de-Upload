<?php


namespace vendor;


class Autoload
{
    static function register()
    {
        self::set_base_constants();

        spl_autoload_register( function($class_name) {

            $path = CONFIG_GLOBAL['Core']['app_path'];

            $filename = DOCUMENT_ROOT . DS . $path . DS . $class_name . ".php";

            if (!file_exists($filename)) {

                $filename = str_replace('\\', '/', $filename);

                if (file_exists($filename)) {

                    require $filename;

                    return true;
                }

            } else {

                require_once $filename;

                return true;

            }
            throw new \Exception("[{$class_name}] can't load on ' {$filename} '");
        });
    }

    static function set_base_constants()
    {

        if (!defined('DS'))
            define('DS', DIRECTORY_SEPARATOR);

        if (!defined('DOCUMENT_ROOT'))
            define('DOCUMENT_ROOT', CONFIG_GLOBAL['Core']['base_dir'] . DS);

    }
}