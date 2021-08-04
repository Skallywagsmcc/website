<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\Article;
use App\Http\Models\Charter;
use App\Http\Models\Comment;
use App\Http\Models\Event;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class HomeController
{
    public function index(Url $url, Validate $validate)
    {
//        Cpunt users
        $users = User::all();
//        Count articles
        $articles = Article::all();
//        Count Events
        $events = Event::all();
//        count Charters
        $charters = Charter::all();
//        Count Images
        $images = Image::all();
//        Count Comments
        $comments = Comment::all();
        $featured = FeaturedImage::all()we;
        $options = ["url" => $url,
            "users" => $users,
            "articles" => $articles,
            "events" => $events,
            "charters" => $charters,
            "images"=>$images,
            "comments"=>$comments,
            "featured"=>$featured];

        echo TemplateEngine::View("Pages.Backend.AdminCp.index", $options);
    }
}