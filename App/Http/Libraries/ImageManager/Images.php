<?php


namespace App\Http\Libraries\ImageManager;


use Closure;

class Images
{


    public static $ValidType;
    public static $upload_dir = __DIR__ . '/../../../../../public_html/img/uploads/';
    public static $values;
    public static $hashed_name;
//    Add vaid type variable
    public static $name;


    public function __construct()
    {
        self::$ValidType = true;
    }




//   input name goes in this field

    public static function MoveFile($tmp, $name)
    {
        if (move_uploaded_file($tmp, self::$upload_dir . $name)) {
            return true;
        } else {
            return false;
        }
    }


    public static function get_hashed_name($name)
    {
        return self::$hashed_name . "." . self::pathparts($name)["extension"];
    }

    public static function pathparts($name)
    {
        return pathinfo($name);
    }

    public function upload($name = null)
    {
        if ((self::check_dir(self::$upload_dir) == true) && (is_writable(self::$upload_dir))) {
            if (is_null($name)) {
                self::$name = "upload";
            } else {
                self::$name = $name;
            }
        } else {
            exit("Folder Doesnt exisit or the permissions are not correct");
        }
        return $this;
    }

    public static function check_dir($dir)
    {
        if (is_dir($dir)) {
            return true;
        } else {
            return false;
        }
    }

    public function set_hashed_name($name)
    {
        return self::$hashed_name = uniqid(md5($name . '-' . microtime()));
    }

    public function ValidFileType($allowed)
    {
        self::$ValidType = $allowed;
        return $this;
    }


    public function Save($id, Closure $closure)
    {

        if (is_array(self::Files("name"))) {
            for ($i = 0; $i < count(self::Files("name")); $i++) {
                $closure($id,$i);
            }
        } else {
            $closure($id);
        }
        return $this;
    }

    public static function Files($key)
    {
        return $_FILES[self::$name][$key];
    }



}


