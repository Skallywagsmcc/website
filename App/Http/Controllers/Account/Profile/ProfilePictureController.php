<?php


namespace App\Http\Controllers\Account\Profile;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\ImageManager\Images;
use App\Http\Models\Image;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class ProfilePictureController
{

    public function index(Url $url)
    {

        $user = User::find(Auth::id());
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.Picture", ["user", $user, "url" => $url]);
    }


    public function create()
    {

    }

    public function store(Url $url, Validate $validate, Images $images,Csrf $csrf)
    {
//        Fixed as of $today
        if($csrf->Verify()==true) {
            $user = User::find(Auth::id());
            $validate = new Validate();
            $images->upload("upload")->Save($id = $user, function ($id) {
                $name = Images::Files("name");
                $tmp = Images::Files("tmp_name");
                $size = Images::Files("size");
                $type = Images::Files("type");
                echo $type;
                Images::set_hashed_name($name);
                move_uploaded_file($tmp, Images::$upload_dir . Images::get_hashed_name($name));
                $image = new  Image();
                $image->user_id = Auth::id();
                $image->image_name = Images::get_hashed_name($name);
                $image->description = "A profile picture";
                $image->image_size = $size;
                $image->image_type = $type;
                $image->save();

                $profile = $id->Profile()->where("user_id", Auth::id())->get()->first();
                $profile->profile_pic = $image->id;
                $profile->save();
            });
            redirect($url->make("account.home"));
        }
    }


}