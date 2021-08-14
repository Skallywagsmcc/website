<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Likes;
use App\Libraries\LikesManager\LikeManager;
use MiladRahimi\PhpRouter\Url;

class FeaturedController
{
    public function index(Url $url)
    {
        $featured = FeaturedImage::where("status",">=",0)->orderBy("id","desc");
        $count = $featured->count();
        $page = new LaravelPaginator(5, "page");
        $featured = $page->paginate($featured);
        $links = $page->page_links();
        echo TemplateEngine::View("Pages.Backend.Featured.index", ["url" => $url, "featured" => $featured, "count" => $count,"links"=>$links]);
    }

    public function review(Url $url, $id)
    {
        $id = base64_decode($id);
        $featured = FeaturedImage::where("id",$id)->get();
        $likes = new LikeManager();
        echo TemplateEngine::View("Pages.Backend.Featured.manage", ["url" => $url, "featured" => $featured->first(),"count"=>$featured->count(),"likes"=>$likes]);

//        View the image for the featured section
    }


//    Approve

public function manage(Url $url, $id,$status)
{
    $id = base64_decode($id);
    $request = FeaturedImage::where("id",$id)->get();
    if($request->count() == 1)
    {
        $request = $request->first();

        if($status == 0)
        {
            $request->status = 0;
        }
        elseif($status==2)
        {
            $request->status = 2;
        }
        $request->save();
    }
    redirect($url->make("auth.admin.featured.home"));
}




//Reject

    public function approve(Url $url, $id)
    {
        $id = base64_decode($id);
        $request = FeaturedImage::where("id",$id)->get();
        if($request->count() == 1)
        {
            $request = $request->first();
            $request->status = 2;
            $request->save();
        }
        redirect($url->make("auth.admin.featured.home"));
    }


//    cancel requests
//These need to be form based
    public function delete(Url $url, $id)
    {
        $id = base64_decode($id);
        $featured = FeaturedImage::where("id",$id);
        if($featured->count() == 1)
        {
            $featured->delete();
        }
        else
        {
            echo "No Id Found";
        }
        redirect($url->make("auth.admin.featured.home"));
    }

    /*Create a colum in settings  to auto allow submissions*/
}