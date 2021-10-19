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

    public $request;

    public function __construct(ServerRequest $request)
    {
        $request = $request->getQueryParams();
    }


    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Frontend.Search.index", ["url" => $url]);
    }

    public function view(Url $url,ServerRequest $request)
    {
        $keyword = $request->getQueryParams()['keyword'];
        $limit = 5;
        $ap = new LaravelPaginator($limit, "p");
        $ep = new LaravelPaginator($limit, "p");
        $up = new LaravelPaginator($limit, "p");
        $cp = new LaravelPaginator($limit, "p");

        $articles = $ap->paginate($this->getarticles($keyword));
        $users = $up->paginate($this->getusers($keyword));
        $events = $ep->paginate($this->getevents($keyword));
        $charters = $cp->paginate($this->getcharters($keyword));


        echo TemplateEngine::View("Pages.Frontend.Search.view",
            ["users" => $users, "charters" => $charters, "articles" => $articles, "events" => $events,
                "url" => $url, "p"=>$p, "keyword" => $keyword,"limit"=>$limit]);


    }


    public function viewtype($type,Url $url,ServerRequest $request)
    {

//        Link the pagination limit
        $keyword = $request->getQueryParams()['keyword'];
        $limit = 5;
        $ap = new LaravelPaginator($limit, "p");
        $ep = new LaravelPaginator($limit, "p");
        $up = new LaravelPaginator($limit, "p");
        $cp = new LaravelPaginator($limit, "p");

        $articles = $ap->paginate($this->getarticles($keyword));
        $users = $up->paginate($this->getusers($keyword));
        $events = $ep->paginate($this->getevents($keyword));
        $charters = $cp->paginate($this->getcharters($keyword));

        $p = [
            "users"=>$up->page_links("?keyword=$keyword&"),
            "articles"=>$ap->page_links("?keyword=$keyword&"),
            "charters"=>$ap->page_links("?keyword=$keyword&"),
            "events"=>$ap->page_links("?keyword=$keyword&"),
        ];

        echo TemplateEngine::View("Pages.Frontend.Search.view",
            ["users" => $users, "charters" => $charters, "articles" => $articles, "events" => $events,
                "url" => $url, "p"=>$p, "keyword" => $keyword,"type"=>$type]);
    }

    public function getusers($keyword)
    {
        return User::where("username", $keyword)->orwherehas("Profile", function ($q) use ($keyword) {
            $q->where("first_name","LIKE","%$keyword%")->orwhere("last_name","LIKE","%$keyword%")->orwhere("first_name","last_name",$keyword);
        })->orwherehas("Article",function($q) use ($keyword)
        {
            $q->where("title","LIKE","%$keyword%");
        })->orwherehas("events",function($q) use ($keyword)
        {
            $q->where("title","LIKE","%$keyword%");
        });
    }

    public function getarticles($keyword)
    {
        return Article::where("title", "LIKE", "%$keyword%")->orwhere("content", "LIKE", "%$keyword%")->orwherehas("User", function ($q) use ($keyword) {
            $q->where("username", $keyword)->orwherehas("Profile",function ($q) use ($keyword)
            {
               $q->where("first_name","LIKE","%$keyword%")->orwhere("last_name","LIKE","%$keyword%");
            });
        });
    }
//
    public function getcharters($keyword)
    {
        return Charter::where("title", "LIKE", "%$keyword%")->orwhere("content", "LIKE", "%$keyword%")->orwherehas("User", function ($q) use ($keyword) {
            $q->where("username", $keyword)->orwherehas("Profile",function ($q) use ($keyword)
            {
               $q->where("first_name","LIKE","%$keyword%")->orwhere("last_name","LIKE","%$keyword%");
            });
        });
    }

    public function getevents($keyword)
    {
        return Event::where("title", "LIKE", "%$keyword%")->orwhere("content", "LIKE", "%$keyword%")->orwherehas("User", function ($q) use ($keyword) {
            $q->where("username", $keyword)->orwherehas("Profile",function ($q) use ($keyword)
            {
               $q->where("first_name","LIKE","%$keyword%")->orwhere("last_name","LIKE","%$keyword%");
            });
        });

    }

}