<?php


namespace App\Http\Functions;
use Jenssegers\Blade\Blade;

class BladeEngine
{

    public static $views = __DIR__ . "/../../../Views";
    public static $cache = __DIR__ . "/../../../Storage/Cache";

    public static function View($pages,$arrays=null)
    {
//        check for diretory
        if (!is_dir(self::$views)) {
            echo "The Directory: cannot be found";
            exit();
        }
        else
        {
            if(($arrays == null) || is_null($arrays))
            {
                $arrays = [];
            }
            $blade = new Blade(self::$views,self::$cache);
            return  $blade->render($pages,$arrays);
        }


//        self::checkdir(self::$views);


//        Check for files

    }

    public static function hello()
    {
        echo "Hello";
    }

//    Check if value is null

    public static function checkdir($dir)
    {
        if (!is_dir($dir)) {
            echo "The Directory: $dir cannot be found";
            exit();
        }
    }

    protected function isnull($value)
    {
        if ($value == null) {
            $value = [];
        }

        return $value;
    }

}