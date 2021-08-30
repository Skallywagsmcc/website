<?php


namespace App\Http\Libraries\ImageManager;


use Closure;

class ImageUploader
{
//  Storage variables
    public $filename;
    public $uploaded;
    public $error_message;
    public $validFiles;

//  Error variables
//  Request variables
    private $upload_dir;
//  Success variables
    private $hashed_name;
    private $_file;

    public function __construct()
    {
        $this->is_valid = true;
        $this->upload_dir = UPLOAD_DIR;
    }

    public function validformat($allowed)
    {
        $this->is_valid = false;
        $this->validFiles = $allowed;
        return $this;
    }

    public function files($name, $key)
    {
        return $_FILES[$name][$key];
    }

//Private Functions

    public function upload($name)
    {
//
        $this->filename = $this->SetFile($name);
        if (!is_dir($this->upload_dir)) {
            $this->error_message = "directotry does not exisit";
        } elseif (($this->is_valid == false) && ($this->RequiredType() == false)) {
            $this->error_message = "Required Files are invalid";
        }
        else {
            $this->SetUniqueName($this->GetFile("name"));
            if ($this->movefiles($this->GetUniqueName()) == false) {
                $this->error_message = "image upload has failed Please check directory or filename is correct";
            }
        }
        return $this;
    }


//    move uploaded files function goes here

    private function SetFile($name)
    {
        $this->_file = $_FILES[$name];
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

    public function GetFile($key)
    {
        return $this->_file[$key];
    }

    /*the Functions listed below are designed to be on controllers meaning these are public and can be manipulated by the end user as they see fit */

//Check filetypes are valid

    private function RequiredType()
    {
        $ext = $this->pathparts($this->GetFile("name"))["extension"];
        if (!in_array($ext, $this->validFiles)) {
            $this->error_message = "Please Upload the required File format";
            return false;
        } else {
            $this->is_valid = true;
            return true;
        }

    }

    public function pathparts($name)
    {
        return pathinfo($name);
    }

    private function SetUniqueName($name)
    {
        $this->hashed_name = uniqid(md5($name . '-' . microtime()));
    }

    private function movefiles($name)
    {
        if (move_uploaded_file($this->GetFile("tmp_name"), $this->upload_dir . $name)) {
            return true;
        } else {
            return false;
        }
    }

    public function GetUniqueName()
    {

        return $this->hashed_name . "." . $this->pathparts($this->GetFile("name"))["extension"];
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


