<?php


namespace App\Http\Controllers\Profile;


use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Image;
use App\Http\Models\User;

class ImageController
{

    public static $uploaderror;

    public function __construct()
    {
        self::$uploaderror = true;
    }

    public function create()
    {

    }

    public function store()
    {
        $dir = __DIR__ . '/../../../../img/uploads/';
        if (is_dir($dir)) {
            $tmp = $_FILES['upload']['tmp_name'];
            $name = $_FILES['upload']['name'];
            $path_parts = pathinfo($name);
            $fileName = $path_parts['filename'];
            $ext = $path_parts['extension'];
            $name = uniqid(md5($name.'-'.microtime()));


            if(move_uploaded_file($tmp,$dir.$name.'.'.$ext))
            {
                $image = new Image();
                $image->user_id = Auth::id();
                $image->image_name = $name.".".$ext;
                $image->image_size = $_FILES['upload']['size'];
                $image->image_type = $_FILES['upload']['type'];
                $image->save();
                redirect($_SERVER['HTTP_REFERER']);
            }

//            Add to database tomorrow.


        }
        else
        {
            echo "Please create the folder and give it the correct permissions";
        }
    }

    public function edit()
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

        if (User::where("id", Auth::id())->get()->count() == 1) {
            $comment = Image::where("id", base64_decode($id))->get();
            if ($comment->count() == 1) {
                Image::find(base64_decode($id))->delete();
                redirect($_SERVER['HTTP_REFERER']);
            }


        }
    }



}