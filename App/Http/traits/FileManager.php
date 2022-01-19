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

//  Error variables

//  Request variables
    public $success;
    public $is_valid;
    
//  Success variables
    public $upload_dir;
    private $hashed_name;
    private $file;

    public function UploadDir($dir=null)
    {
        $root = $_SERVER['DOCUMENT_ROOT'];
        if(is_null($dir))
        {
            $this->upload_dir = $root."/img/uploads/";
        }
        else
        {
            $this->upload_dir = $dir;
        }
        return $this->upload_dir;
    }

    //Acce
    public function AcceptedTypes($overwrite=null)
    {
        if(is_null($overwrite))
        {
            $values = ["jpg","jpeg","png"];
        }
        else
        {
            $values = $overwrite;
        }
        return $values;
    }

    
//    Check for Required file type return true or false
    private function Required($name,$vales)
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


//    Along with  Upload Dir this will start the upload process a new one is require per upload. need to  find a better way to run this
    public function processUpload($name)
    {
//        Instantiate
        $this->SetFile($name);
//       return values;
        $this->filename = $this->GetFile("name");
        $this->MakeUnique($this->filename);
        $this->filesize = $this->GetFile("size");
        $this->filetype = $this->GetFile("type");
//
//       echo $this->filetype  . " | ". $this->filename  . " | ".$this->filesize  . " | ". $this->fileerror;

    }


//    this is a setter to replicate $_FILES['name']['type']
    private function SetFile($name)
    {
        $this->file = $_FILES[$name];
    }


//    A function used to replace the need for $_FILES['a name']["type]
    public function GetFile($key)
    {
        return $this->file[$key];
    }

//    Create a unique name
    public function MakeUnique($name)
    {
        $this->hashed_name = uniqid(md5($name . '-' . microtime())) . "." . $this->pathparts($this->GetFile("name"))["extension"];
    }


    public function pathparts($name)
    {
        $this->extention = pathinfo($name);
        return $this->extention;
    }

//    Set Name to a unique name
    public function fileerror($name)
    {
        return $_FILES[$name]["error"] != 4 ? true : false;
    }


    //Get file size of uploaded image
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
    //unlink file
    public function removeimage($name)
    {
        unlink(implode("",$this->upload_dir) . $name);
    }


    //this function moved the image from temp folder to upload
    private function upload()
    {
        if (move_uploaded_file($this->GetFile("tmp_name"), $this->upload_dir . $this->hashed_name)) {
            $this->success = true;
            return true;

        } else {
            $this->success = false;
            return false;

        }
    }


}