<?php


namespace Layout;

use Core;

class DrawStaticComponent extends DrawConfig implements DrawModel
{
    private $path;

    public function __construct(string $name)
    {
        $this->set_path();
        $this->draw($name);
    }

    public function exists(string $name) : bool
    {
        if (is_dir($this->path)) {
            if (file_exists( $this->get_full_dir($name) ))
                return true;
        }

        return false;
    }

    private function set_path()
    {
        $this->path = Core\Path::get_real_path('{base}/' . self::Config['base_path']);
    }

    public function draw(string $name)
    {
        if ($this->exists($name)) {
            include $this->get_full_dir($name);
        }
        else {
            $notFound = $this->get_full_dir('not-found');

            if (self::Config['show_not_found'])
                if ( file_exists( $notFound ) )
                    include $notFound;
        }
    }

    public function get_full_dir($name): string
    {
        return Core\Path::get_real_path($this->path . '/' . $name . '.php');
    }
}