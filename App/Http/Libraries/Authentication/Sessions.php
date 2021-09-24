<?php


namespace App\Http\Libraries\Authentication;

class Sessions
{
    protected static $name;
    protected static $value;

    public static function Create($name, $value)
    {
        $_SESSION[$name] = $value;
        return new static();
    }

    public static function Destroy($name)
    {
        unset($_SESSION[$name]);
        return new static();
    }

    public static function Read($name = null)
    {
        return $_SESSION[$name];
    }

}