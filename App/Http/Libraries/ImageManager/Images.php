<?php


namespace App\Http\Libraries\ImageManager;


use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Image;

class Images
{

    public static $type;
    public static $ValidType;
    public static $upload_dir = __DIR__ . '/../../../../../public_html/img/uploads/';
//    Add vaid type variable
    public static $name;

    public function __construct()
    {
        self::$ValidType = true;
    }


//   input name goes in this field

    public static function Validate($name = "upload")
    {
        self::$name = $name;
        return new static();
    }

    public function Required($allowed)
    {
        self::$ValidType = false;
        $allowed[] = $allowed;
        $filename = $_FILES[self::$name]['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            self::$ValidType = false;
        } else {
            self::$ValidType = true;
        }
        return $this;
    }


    public static function Files($name,$key)
    {
        return $_FILES[$name][$key];
    }

    public function upload()
    {
        if (self::check_dir() == true) {
//            upload the file from here.
            if(self::$ValidType == true)
            {
                $tmp = $_FILES[self::$name]['tmp_name'];
                $name = $_FILES[self::$name]['name'];
                $path_parts = pathinfo($name);
                $fileName = $path_parts['filename'];
                $ext = $path_parts['extension'];
                $name = uniqid(md5($name.'-'.microtime()));
                self::$name = $name .'.'.$ext;
                if(move_uploaded_file($tmp,self::$upload_dir.$name.'.'.$ext))
                {
                    return true;
                }
                else
                {
                    return false;
                }

//                Upload image is true

            }
            else
            {
                Validate::$error = "Upload failed File is not valid;";
                return false;
            }
        } else {
            Validate::$error =  "Please create the folder";

        }
    }


    public static function check_dir()
    {
        if (is_dir(self::$upload_dir)) {
            return true;
        } else {
            return false;
        }
    }

}


