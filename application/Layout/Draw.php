<?php


namespace Layout;


class Draw
{

    public static function component(string $name) : DrawStaticComponent
    {
        return new DrawStaticComponent($name);
    }
}