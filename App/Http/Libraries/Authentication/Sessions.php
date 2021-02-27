<?php


namespace App\Http\Libraries\Authentication;

class Sessions
{
    protected static $name;
    protected static $value;

    public static function Create($name, $value)
    {
        self::$name = $name;
        self::$value = $value;
    }

    public static function Destroy($name)
    {
        unset($_SESSION[$name]);
    }

    public static function Read($name = null)
    {
        return $_SESSION[$name];
    }

}