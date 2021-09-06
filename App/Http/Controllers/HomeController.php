<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Event;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Article;
use App\Http\Models\Member;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public function index(Url $url)
    {
        $pages = Article::orderBy("id", "desc")->limit(4)->get();
        $events = Event::where("end_at",">=",date("Y-m-d"))->orderBy("id","asc")->limit(1)->get();
        
        $featured = FeaturedImage::inRandomOrder()->where("status", 2)->limit(3)->get();
        echo TemplateEngine::View("Pages.Frontend.Homepage.index", ["url" => $url, "featured" => $featured, "pages" => $pages,"events"=>$events]);
    }


}