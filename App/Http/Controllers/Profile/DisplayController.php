<?php


namespace App\Http\Controllers\Profile;

use App\Http\Functions\BladeEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\User;

class DisplayController
{
//    This controlle Will be used for displaying the profile infirmation

    public function index($username)
    {

        $user = User::where("username", $username)->get();
        $count = $user->count();
        $user = $user->first();
        if($count == 1)
        {
            echo BladeEngine::View("Pages.Frontend.Profile.index", ["user" => $user]);
        }
        else
        {
            echo "Page not found";
        }

    }

    public function gallery($username)
    {
        $user = User::where("username", $username)->get();
        $count =  $user->first()->images->count();
        echo BladeEngine::View("Pages.Frontend.Profile.Gallery.index", ["user" => $user->first(),"count"=>$count]);

    }

    public function DisplayImage($username,$id)
    {
        $id = base64_decode($id);
        $user = User::where("username", $username)->get()->first();
        $image  = $user->images()->where("id",$id);
        $count = $image->count();
        $image = $image->get()->first();
        echo BladeEngine::View("Pages.Frontend.Profile.Gallery.view", ["user" => $user,"image"=>$image,"count"=>$count]);

//
    }

}