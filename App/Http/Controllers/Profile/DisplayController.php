<?php


namespace App\Http\Controllers\Profile;

use App\Http\Functions\BladeEngine;
use App\Http\Models\Image;
use App\Http\Models\User;

class DisplayController
{
//    This controlle Will be used for displaying the profile infirmation


    public function index($username)
    {
        $user = User::where("username", $username)->get();
        $count = $user->count();
        $user = $user->first();
        echo BladeEngine::View("Pages.Frontend.Profile.index", ["user" => $user]);
    }

    public function gallery($username)
    {
        $user = User::withCount("gallery")->where("username", $username)->get();

        $count = $user->first()->gallery_count;
        echo BladeEngine::View("Pages.Frontend.Profile.Gallery.index", ["user" => $user->first()]);

    }

    public function DisplayImage($username,$id)
    {
        $user = User::where("username", $username)->get()->first();
        $image = Image::where("id",base64_decode($id))->get();
        $count = $image->count();
            $image = $image->first();
        echo BladeEngine::View("Pages.Frontend.Profile.Gallery.view", ["user" => $user,"image"=>$image,"count"=>$count]);
    }

}