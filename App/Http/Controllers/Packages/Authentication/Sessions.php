<?php


namespace App\Http\Packages\Authentication;


class Sessions
{
    protected static $name;
    protected static $value;

    public static $loggedin;

    public static function New($name, $value)
    {
        self::$name = $name;
        self::$value = $value;
        return new static();
    }


    public function Create()
    {
        $_SESSION[self::$name] = self::$value;
        self::$loggedin = true;
        return $this;
    }

    public Static function CreateCookie($name,$value,$days)
    {
        setcookie($name,$value,time()+3600*24*$days,"/",".". $_SERVER['HTTP_HOST']);
    }


    public Static function DestroyCookie($name,$value,$days)
{
    setcookie($name,$value,time()-3600*24*$days,"/",".". $_SERVER['HTTP_HOST']);
}


    public static function Destroy($name=null)
    {
        if (is_null($name) || $name == null) {
            $name = self::$name;
        }
        unset($_SESSION[$name]);
        return new static();
    }

    public function Read($name = null)
    {
        if (is_null($name) || $name == null) {
            $name = self::$name;
        }
        return $_SESSION[$name];
    }

}