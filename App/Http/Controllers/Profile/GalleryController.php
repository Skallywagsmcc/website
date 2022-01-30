<?php


namespace App\Http\Controllers\Profile;

use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use mbamber1986\Authclient\Auth;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class GalleryController
{

    public $entity_name;
    public $user;
    public $images;
    public $links;

    public function __construct()
    {
        $this->entity_name = "page/gallery";
    }

//    This controlle Will be used for displaying the profile infirmation



    public function index($username,Url $url,Auth $auth)
    {
        $this->user = User::where("username", $username)->get();
        $this->user->count() == 1 ? $this->user = $this->user->first(): false;
        $pagination = new LaravelPaginator("9","page");
        $this->images =  $this->user->first()->images()->where("entity_name",$this->entity_name)->where("user_id",$this->user->id);
        $this->images = $pagination->paginate($this->images);
        $this->links = $pagination->page_links();
        echo TemplateEngine::View("Pages.Frontend.Profile.gallery",["url"=>$url,"Auth"=>$auth,"request"=>$this]);

    }

    public function show($username,$id,Url $url)
    {

//        TODO Refactor this code to support Request=>$this, Remove Featured Images for now.
        $id = base64_decode($id);
        $this->$user = User::where("username", $username)->get()->first();
        $this->images  = $user->first()->images()->where("id",$id)->where("entity_name",$this->entity_name);
        $count = $this->images->count();
        $this->image = $this->images->get()->first();
//        $featured = FeaturedImage::where("image_id",$image->id)->get()->first();
        echo TemplateEngine::View("Pages.Frontend.Profile.view", ["user" => $user,"image"=>$image,"count"=>$count,"url"=>$url,"featured"=>$featured]);

//
    }

}