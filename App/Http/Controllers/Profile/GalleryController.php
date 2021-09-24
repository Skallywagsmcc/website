<?php


namespace App\Http\Controllers\Profile;

use App\Http\Functions\TemplateEngine;
use mbamber1986\Authclient\Auth;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class GalleryController
{
//    This controlle Will be used for displaying the profile infirmation



    public function index($username,Url $url,Auth $auth)
    {
        $user = User::where("username", $username)->get();
        $count =  $user->first()->images->count();
        echo TemplateEngine::View("Pages.Frontend.Profile.gallery", ["user" => $user->first(),"count"=>$count,"url"=>$url,"Auth"=>$auth]);

    }

    public function show($username,$id,Url $url)
    {
        $id = base64_decode($id);
        $user = User::where("username", $username)->get()->first();
        $image  = $user->first()->images()->where("id",$id)->where("nvtug",0);
        $count = $image->count();
        $image = $image->get()->first();
        $featured = FeaturedImage::where("image_id",$image->id)->get()->first();
        echo TemplateEngine::View("Pages.Frontend.Profile.view", ["user" => $user,"image"=>$image,"count"=>$count,"url"=>$url,"featured"=>$featured]);

//
    }

}