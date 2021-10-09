<?php


namespace App\Http\Libraries\Authentication;


class Cookies
{
    private static $name;
    private static $destroy;
    private static $value;
    private static $days;
    private static $path;
    private static $host;
    private static $secure;
    private static $http_only;

    public function __construct()
    {
        self::$destroy = false;
        self::$path = "/";
        self::$days = "";
        self::$host = "";
        self::$secure = "";
        self::$http_only = "";

    }

    public static function Create($name, $value)
    {
        self::$name = $name;
        self::$value = $value;
        return new static();
    }

    public static function Destroy($value)
    {
        self::$destroy = true;
        self::$name = $value;
        return new static();
    }

    public function Days($value)
    {
        self::$days = $value;
        return $this;
    }

    public function Path($value)
    {
        self::$path = $value;
        return $this;
    }

    public function Host($value)
    {
        self::$host = $value;
        return $this;
    }

    public function Secure($value)
    {
        self::$host = $value;
        return $this;
    }

    public function Http($value)
    {
        self::$http_only = $value;
        return $this;
    }

    public function Save()
    {

        if (self::$destroy == true) {
            $expire = time() - 60 * 60 * 24 * self::$days;
            if (setcookie(self::$name, "", $expire)) {

            }
        } else {
            $name = self::$name;
            $value = self::$value;
            empty(self::$days) ? $expire = time() + 3600 : $expire = time() + 60 * 60 * 24 * self::$days;
            self::$path == "/" ? $path = "/" : $path = self::$path;
            empty(self::$host) ? $host = "" : $host = self::$host;
            empty(self::$secure) ? $secure = false : $secure = self::$secure;
            empty(self::$http_only) ? $http = false : $http = self::$http_only;
            if (setcookie($name, $value, $expire, $path, $host, $secure, $http)) {
            } else {
                Authenticate::$errmessage = "Sorry the cookie could not be created";
            }
        }
        return $this;

    }


}