<?php


namespace Layout;


interface DrawModel
{

    public function exists(string $name) : bool;

    public function draw(string $name);

    public function get_full_dir($name) : string;

    public function set_path() : void;
}