<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\Event;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Article;
use App\Http\Models\Member;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public function index(Url $url)
    {
        echo date("Y-m-d");
        $pages = Article::orderBy("id", "desc")->limit(4)->get();
        $members = Member::orderBy("id","desc")->limit(1)->get();
        $events = Event::where("end",">=",date("Y-m-d"))->orderBy("id","asc")->limit(1)->get();


        $featured = FeaturedImage::inRandomOrder()->where("status", 2)->limit(3)->get();
        echo TemplateEngine::View("Pages.Frontend.Homepage.index", ["url" => $url, "featured" => $featured, "pages" => $pages,"member"=>$members,"events"=>$events]);
    }


}