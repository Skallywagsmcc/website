<?php


namespace App\Http\Controllers\Profile;

use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class DisplayController
{
//    This controlle Will be used for displaying the profile infirmation

    public function index($username,Url $url)
    {
        $user = User::where("username", $username)->get();
        $count = $user->count();
        $user = $user->first();
        if($count == 1)
        {
            echo TemplateEngine::View("Pages.Frontend.Profile.index", ["user" => $user,"url"=>$url]);
        }
        else
        {
            echo "Article not found";
        }

    }

    public function gallery($username,Url $url,Auth $auth)
    {
        $user = User::where("username", $username)->get();
        $count =  $user->first()->images->count();
        echo TemplateEngine::View("Pages.Frontend.Profile.Gallery.index", ["user" => $user->first(),"count"=>$count,"url"=>$url,"auth"=>$auth]);

    }

    public function DisplayImage($username,$id,Url $url)
    {
        $id = base64_decode($id);
        $user = User::where("username", $username)->get()->first();
        $image  = $user->images()->where("id",$id);
        $count = $image->count();
        $image = $image->get()->first();
        $featured = FeaturedImage::where("image_id",$image->id)->get()->first();
        echo TemplateEngine::View("Pages.Frontend.Profile.Gallery.view", ["user" => $user,"image"=>$image,"count"=>$count,"url"=>$url,"featured"=>$featured]);

//
    }

}