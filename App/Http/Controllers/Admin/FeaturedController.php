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
        $featured = FeaturedImage::where("status",">=",1);
        $count = $featured->count();
        $page = new LaravelPaginator(5, "page");
        $featured = $page->paginate($featured);
        $links = $page->page_links();
        echo TemplateEngine::View("Pages.Backend.Featured.index", ["url" => $url, "featured" => $featured, "count" => $count,"links"=>$links]);
    }

    public function edit(Url $url, $id,Validate $validate)
    {
        $id = base64_decode($id);
        $featured = FeaturedImage::find($id);
        $likes = new LikeManager();
        echo TemplateEngine::View("Pages.Backend.Featured.manage", ["url" => $url, "featured" => $featured,"likes"=>$likes]);

//        View the image for the featured section
    }

    public function store(Url $url, Validate $validate, Csrf $csrf)
    {
        if ($csrf->Verify() == true) {
            $featured = FeaturedImage::find($validate->Post("id"));
            if ($featured->count() >= 1) {
                $featured->status = $validate->Post("status");
                $featured->save();
            } else {
                echo "Image not found";
            }
            redirect($url->make("auth.admin.featured.home"));
        }
    }

    public function delete(Url $url, $id)
    {

    }

    /*Create a colum in settings  to auto allow submissions*/
}