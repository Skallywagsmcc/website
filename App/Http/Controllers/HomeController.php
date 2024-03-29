<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\Event;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Article;
use App\Http\Models\Profile;
use App\Http\Models\User;
use Laminas\Diactoros\ServerRequest;
use App\Http\traits\Activity_log;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Routing\Route;
use MiladRahimi\PhpRouter\Url;

class HomeController
{
use Activity_log;

    public function index(Url $url)
    {

        $pages = Article::orderBy("id", "desc")->limit(4)->get();
        $events = Event::where("end_at",">=",date("Y-m-d"))->orderBy("id","asc")->limit(1)->get();
        $profile = Profile::where("is_crew",1)->get();

        $featured = FeaturedImage::inRandomOrder()->where("status", 2)->limit(3)->get();
        echo TemplateEngine::View("Pages.Frontend.Homepage.index", ["url" => $url, "featured" => $featured, "pages" => $pages,"events"=>$events,"members"=>$profile]);
    }


}