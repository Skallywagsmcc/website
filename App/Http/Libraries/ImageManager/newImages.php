<?php


namespace App\Http\Libraries\ImageManager;


use Closure;

class newImages
{
//  Storage variables
    public $filename;
    public $uploaded;
    public $error_message;
    public $is_valid;

//  Error variables
//  Request variables
    private $upload_dir;
//  Success variables
    private $hashed_name;
    private $is_valid;

    public function __construct()
    {
        $this->is_valid = true;
        $this->upload_dir = UPLOAD_DIR;
    }


    public function validformat($allowed = null)
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
        } elseif ($this->is_valid == false) {
            $this->error_message = "Required Files are invalid";
        } else {
            $this->sethashedName($this->GetFile("name"));
            if ($this->movefiles($this->gethashedname()) == false) {
                $this->error_message = "image upload has failed Please check directory or filename is correct";
            }
        }
        return $this;
    }


//    move uploaded files function goes here

        private
        function SetFile($name)
        {
            $this->file = $_FILES[$name];
        }

        private
        function sethashedName($name)
        {
            $this->hashed_name = uniqid(md5($name . '-' . microtime()));
        }

        public
        function GetFile($key)
        {
            return $this->file[$key];
        }

        /*the Functions listed below are designed to be on controllers meaning these are public and can be manipulated by the end user as they see fit */

//Check filetypes are valid

        private
        function movefiles($name)
        {
            if (move_uploaded_file($this->GetFile("tmp_name"), $this->upload_dir . $name)) {
                return true;
            } else {
                return false;
            }
        }

        public
        function gethashedname()
        {

            return $this->hashed_name . "." . Images::pathparts($this->GetFile("name"))["extension"];
        }

        public
        function save(Closure $closure)
        {
            return $closure();
        }

        private
        function RequiredType($allowed)
        {

            $ext = Images::pathparts($this->GetFile("name"))["extension"];
            if (!in_array($ext, $allowed)) {
                $this->is_valid = false;
            } else {
                $this->is_valid = true;
            }

        }


    }


