<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\ImageManager\Images;
use App\Http\Models\Image;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class ProfilePictureController
{

    public function index(Url $url)
    {
        $user = User::find(Auth::id());
        echo BladeEngine::View("Pages.Frontend.Account.Picture",["user",$user,"url"=>$url]);
    }


    public function create()
    {

    }

    public function store(Url $url)
    {
        $user = \App\Http\Models\User::find(Auth::id());
        echo $user->Profile->first_name;
        $validate = new Validate();
        if (Images::Validate("upload")->Required(["jpeg", "jpg", "png"])->upload() == true) {
            $image = new Image();
            $image->user_id = Auth::id();
            $image->image_name = Images::$name;
            $image->description = "A profile picture";
            $image->image_size = Images::Files("upload", "size");
            $image->image_type = Images::Files("upload", "type");
            $image->save();

            $profile = $user->Profile()->where("user_id",Auth::id())->get()->first();
            $profile->profile_pic = $image->id;
            $profile->save();
        }


        redirect("/profile/{$user->get()->first()->username}/gallery");
    }


}