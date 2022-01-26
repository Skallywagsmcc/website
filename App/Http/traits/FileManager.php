<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;


trait FileManager
{

    //  Storage variables
    public $filename;
    public $filesize;
    public $filetype;
    public $validFiles;

    private $MFS = 8000000; //8MB LIMIT

//  Error variables

//  Request variables
    public $success;
    private  $attached;
    public $is_valid;

//  Success variables
    public $upload_dir;
    private $hashed_name;
    private $file;

    public function UploadDir($dir = null)
    {
        $root = $_SERVER['DOCUMENT_ROOT'];
        if (is_null($dir)) {
            $this->upload_dir = $root . "/img/uploads/";
        } else {
            $this->upload_dir = $dir;
        }
        return $this->upload_dir;
    }


//    Check for Required file type return true or false

    public function EmptyFIle($name)
    {
        return $_FILES[$name]["error"] == 4 ? true : false;
    }


//    Along with  Upload Dir this will start the upload process a new one is require per upload. need to  find a better way to run this


//    this is a setter to replicate $_FILES['name']['type']


    public function Filesize($name,$size=null)
    {
        $this->SetFile($name);
//        Allow Overwriting of default size

        if(is_null($size))
        {
            $size = $this->MFS;
        }

        if($this->GetFIle("size") < $size)
        {
         return true;
        }
        else
        {
            $this->MFS = $size;
            return false;
        }
    }

    public function AttachFile($name)
    {
        $this->SetFile($name);
        $this->attached = $this->GetFile("size");
    }

    function HRFS($bytes=null,$decimals = 2)
    {


            $size = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $factor = floor((strlen($bytes) - 1) / 3);
            return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];

    }

//    A function used to replace the need for $_FILES['a name']["type]

    private function SetFile($name)
    {
        $this->file = $_FILES[$name];
    }

//    Create a unique name

    public function GetFile($key)
    {
        return $this->file[$key];
    }


//    Set Name to a unique name

    public function rmfile($filename)
    {
        return unlink(UPLOAD_DIR . "/" . $filename);
    }

    private function IsSupported($name, $vales)
    {
        $file = $_FILES[$name]["name"];
        $ext = $this->pathparts($file)["extension"];
        if (!in_array($ext, $vales)) {
            return false;
        } else {
            $this->is_valid = true;
            return true;
        }
    }

    public function pathparts($name)
    {
        $this->extention = pathinfo($name);
        return $this->extention;
    }


    //this function moved the image from temp folder to upload

    private function upload($name)
    {

        $this->SetFile($name);
//       return values;
        $this->filename = $this->GetFile("name");
        $this->MakeUnique($this->filename);
        $this->filesize = $this->GetFile("size");
        $this->filetype = $this->GetFile("type");

        return move_uploaded_file($this->GetFile("tmp_name"), UPLOAD_DIR . "/" . $this->hashed_name) ? true : false;
    }


    public function MakeUnique($name)
    {
        $this->hashed_name = uniqid(md5($name . '-' . microtime())) . "." . $this->pathparts($this->GetFile("name"))["extension"];
    }


}