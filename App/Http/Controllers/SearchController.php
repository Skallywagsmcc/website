<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Article;
use App\Http\Models\Charter;
use App\Http\Models\Event;
use App\Http\Models\User;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class SearchController
{


    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Frontend.Search.index",["url"=>$url]);
    }

    public function view(Url $url, ServerRequest $request)
    {
        echo "hello";
        $keyword = $request->getQueryParams()['keyword'];
        echo $keyword;

        $users = User::where("username",$keyword)->orwherehas("Profile",function ($q)  use ($keyword)
        {
            $q->where("first_name",$keyword)->orwhere("last_name",$keyword);
        });
        echo $users->get();
echo "<hr>";

        $articles = Article::where("title","LIKE","%$keyword%")->orwhere("content","LIKE","%$keyword%")->orwherehas("User",function ($q)  use ($keyword) {
            $q->where("username",$keyword);})->get();

        $events = Event::where("title","LIKE","%$keyword%")->orwhere("content","LIKE","%$keyword%")->orwherehas("User",function ($q)  use ($keyword) {
            $q->where("username",$keyword);})->get();


        $charters = Charter::where("title","LIKE","%$keyword%")->orwhere("content","LIKE","%$keyword%")->orwherehas("User",function ($q)  use ($keyword) {
            $q->where("username",$keyword);})->get();


        foreach ($events as $event)
        {
            echo $event->title . "<br>";
        }

        echo "<hr> Articles";
        foreach ($articles as $article)
        {
            echo $article->title . "<br>";
        }

        echo "<hr> Charters";

        foreach ($charters as $charter)
        {
            echo $charter->title . "<br>";
        }

        exit();
    }


}