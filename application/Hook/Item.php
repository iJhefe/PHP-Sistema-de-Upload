<?php


namespace Hook;


class Item
{

    public static function static(string $name, string $type)
    {
        if (strtolower($type) === 'css')
            self::css($name);
        elseif (strtolower($type) === 'js')
            self::javascript($name);
    }

    private static function javascript(string $name)
    {
        return '';
    }

    private static function css(string $name)
    {
        return new CSSFile($name);
    }

}