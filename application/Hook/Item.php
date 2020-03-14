<?php


namespace Hook;


class Item
{

    public static function static(string $name, string $type)
    {
        if (strtolower($type) === 'css')
            self::css($name);
        elseif (strtolower($type) === 'js' || strtolower($type) === 'javascript')
            self::javascript($name);
    }

    private static function javascript(string $name)
    {
        return new JSFile($name);
    }

    private static function css(string $name)
    {
        return new CSSFile($name);
    }

}