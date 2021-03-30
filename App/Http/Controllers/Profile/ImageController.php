<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\ImageManager\Images;
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
        if(Images::Validate("upload")->Required(["jpg","png","jpeg"])->upload() == true)
        {
//            instantiate Validation
            $validate = new Validate();
            echo "upload confirmed ". Images::$name;
//            unlink(Images::$upload_dir.Images::$name);
//

//            Connect to the database table
            $image = new Image();
            $image->user_id = Auth::id();
            $image->image_name = Images::$name;
            $image->description = $validate->Post("description");
            $image->image_size = Images::Files("upload","size");
            $image->image_type = Images::Files("upload","type");
            $image->save();


        }
//        check if image upload is fales
        {
            Validate::$error = "Upload failed please check that you have the correct permissions on the folder or the file matches the required filed type (Jpeg,jpg or png)";

        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit()
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {
        $id = base64_decode($id);
        $user = User::where("id", Auth::id());
        if ($user->count() == 1)
        {
            $image = $user->get()->first()->images($id);
            Image::destroy($id);
//            rmimg($image->get()->first()->image_name);
        redirect("/profile/{$user->get()->first()->username}/gallery");
    }
    }


}