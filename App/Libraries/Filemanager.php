<?php

Namespace App\Libraries;

use Closure;

class Filemanager
{

//  Storage variables
    public $filename;
    public $uploaded;
    public $message;
    public $validFiles;

//  Error variables
//  Request variables
private $upload_root;
    private $upload_dir;
//  Success variables
    private $hashed_name;
    public $success;
    private $_file;

    public function __construct()
    {
        $this->is_valid = true;
        $this->success = false;
//        Change this using the over diroverride function within  your script like so
// $file = new mbamber1986/Filemanager;
//$file->DirOverride("../../img/uploads")->upload("upload");

        $this->upload_root = $_SERVER['DOCUMENT_ROOT'] ."/";

    }


    public function ChangeRoot($root)
    {
//        Use this to override Upload dir
        $this->upload_root = $root;
        return $this;
    }

    public  function AddDir($dir)
    {
//        Trailing slash required;
        $this->upload_dir = $dir;
        return $this;
    }

    public function GetUniqueName()
    {
        return $this->hashed_name;
    }
//Upload value $name only required the name of your file field eg image_upload, upload, file etc SetFile($name) will create $_FILES[];
    public function upload($name,$multiple=null)
    {
//
        $this->SetFile($name);
        if (!is_dir($this->upload_dir)) {
            $this->message = "The directory does not exists";
        }
        elseif (($this->is_valid == false) && ($this->RequiredType() == false)) {
            $this->message = "It Seems you have uploaded an invalid File";
        }
        else
        {
            $this->MakeUnique($this->GetFile("name"));
            if ($this->movefiles($this->GetUniqueName()) == false) {
                $this->message = "image upload has failed Please check directory or filename is correct";
            }
            else{
                $this->success = true;
                $this->message = "Image Upload Success";
            }
        }
        return $this;
    }



//    Setters and getters

    private function SetFile($name)
    {
        $this->_file = $_FILES[$name];
    }

    /*GET file $this->file = $_FILES['$name'] which was set inside SetFile

    $key represents tmp_name name size etc complete result would be $_FILES["upload"]["name"]
    */
    public function GetFile($key)
    {
        return $this->_file[$key];
    }

    public function pathparts($name)
    {
        return pathinfo($name);
    }

//    Set Name to a unique name
    public function MakeUnique($name)
    {
        $this->hashed_name = uniqid(md5($name . '-' . microtime())) .".". $this->pathparts($this->GetFile("name"))["extension"];
    }


    public function validformat($allowed)
    {
        $this->is_valid = false;
        $this->validFiles = $allowed;
        return $this;
    }

    private function RequiredType()
    {
        $ext = $this->pathparts($this->GetFile("name"))["extension"];
        if (!in_array($ext, $this->validFiles)) {
            $this->message = "Please Upload the required File format";
            return false;
        } else {
            $this->is_valid = true;
            return true;
        }

    }




    private function movefiles($name)
    {

        if (move_uploaded_file($this->GetFile("tmp_name"),$this->upload_root.$this->upload_dir.$name)) {
            return true;
        } else {
            return false;
        }
    }



    public function getSize($size)
    {
        $sizes = ['B', 'KB', 'MB', 'GB'];
        $count = 0;
        if ($size < 1024) {
            return $size . " " . $sizes[$count];
        } else {
            while ($size > 1024) {
                $size = round($size / 1024, 2);
                $count++;
            }
            return $size . " " . $sizes[$count];
        }
    }

//use this to delete the image from the directory

    public function save(Closure $closure)
    {
        return $closure();
    }

    public function delete($name)
    {
        unlink($this->upload_dir . $name);
    }

}