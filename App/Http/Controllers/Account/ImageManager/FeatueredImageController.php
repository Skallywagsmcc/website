<?php


namespace App\Http\Controllers\Account\ImageManager;


use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\FeaturedImage;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class FeatueredImageController
{

    public function index()
    {
//        List the images here allowing to be removed.
    }


    public function add($id,Url $url,Auth $auth)
    {
        $id = base64_decode($id);
        $user = User::where("id",$auth::id())->get();
        if($user->count() == 1)
        {
            $featured = FeaturedImage::where("image_id",$id)->get();
            if($featured->count() < 1)
            {
                $featured = new FeaturedImage();
                $featured->user_id = $user->first()->id;
                $featured->image_id = $id;
                $featured->status = 1;
                $featured->save();
            }

        }
        redirect($url->make("images.gallery.update",["id"=>$id]));
    }

    public function delete($id,Url $url)
    {
        $id = base64_decode($id);
        $featured = FeaturedImage::where("id",$id);
        if($featured->count() == 1)
        {
            $featured->delete();
            redirect($url->make("images.gallery.home"));
        }
        else
        {
            echo "no id Found";
        }
    }
}
