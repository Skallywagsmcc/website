<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Article;
use DateTime;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public function index(Url $url)
    {
        $pages = Article::orderBy("id", "asc")->take(5)->get();


        $featured = FeaturedImage::inRandomOrder()->where("status", 2)->limit(4)->get();
        echo TemplateEngine::View("Pages.Frontend.Homepage.index", ["url" => $url, "featured" => $featured, "pages" => $pages]);
    }


}