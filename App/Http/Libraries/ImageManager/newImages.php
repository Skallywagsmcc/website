<?php


namespace App\Http\Libraries\ImageManager;


use App\Http\Libraries\ImageManager\Images;
use Closure;

class newImages
{
//  Storage variables
private $validFiles;
public $filename;
private $upload_dir;
private $hashed_name;
private $file;

//  Error variables
//  Request variables
public $uploaded;
//  Success variables
private $is_valid;


public function __construct()
{
    $this->upload_dir = __DIR__ . '/../../../../../public_html/img/uploads/';
}



private  function SetFile($name)
{
    $this->file = $_FILES['name'];
}


public function GetFile($key)
{
    return $this->file[$key];
}

//Private Functions

    private function RequiredType($name,$allowed)
    {
        $ext = Images::pathparts($name)["extension"];
        if (!in_array($ext,$allowed))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

//    move uploaded files function goes here

private  function sethashedName($name)
{
    $this->hashed_name = uniqid(md5($name . '-' . microtime()));
}

public  function gethashedname()
{
    return $this->hashed_name;
}

private function movefiles($name)
{
    $tmp = $_FILES[$name]["tmp_name"];
    if (move_uploaded_file($tmp, $this->upload_dir . $name)) {
        return true;
    } else {
        return false;
    }
}

/*the Functions listed below are designed to be on controllers meaning these are public and can be manipulated by the end user as they see fit */

//Allowed image upload override

public function OverideDir($dir)
{
    $this->upload_dir = $dir;
    return $this;
}

//Check filetypes are valid
public function validformat($allowed)
{
    $this->validFiles = $allowed;
    return $this;
}


public function files($name,$key)
{
    return $_FILES[$name][$key];
}


public function upload($name)
{
    echo $this->files($name,"tmp_name");
//
//    if($this->RequiredType($name,$this->validFiles) == false)
//    {
////        echo "An Error occurred";
//    }
//    $this->filename = $name;

////    save() is required
    return $this;
}


public function save(Closure $closure)
{
   return  $closure();
}



}


