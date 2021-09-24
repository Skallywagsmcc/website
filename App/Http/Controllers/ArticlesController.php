<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Article;
use App\Http\Models\User;
use App\Libraries\LikesManager\LikeManager;
use Carbon\Carbon;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class ArticlesController
{

    public function index(Url $url)
    {
           $articles = Article::orderBy("created_at","desc");
           $count = $articles->count();
           $pages = new LaravelPaginator('2','p');
           $articles = $pages->paginate($articles);
           $links = $pages->page_links();
           $years = Article::selectRaw('year(created_at) year')
               ->groupBy('year')
               ->orderBy('year', 'desc')
               ->get();
           $users = User::all();
        echo TemplateEngine::View("Pages.Frontend.Articles.index",["pages"=>$pages,"count"=>$count,"users"=>$users,"url"=>$url,"articles"=>$articles,"links"=>$links,"years"=>$years]);


    }

    public function view($slug, Url $url,Auth $auth)
    {
        $article = Article::where("slug",$slug)->get();
        $entry_name = baseclass(get_called_class())->getShortName();
        $likes = new LikeManager();
        $years = Article::selectRaw('year(created_at) year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
        $count = $article->count();
        if(($count == 1))
        {
            $images = $article->first()->images()->where("entry_name",$entry_name)->where("entry_id",$article->first()->id)->get();

//            $date = new \DateTime($article->first()->created_at);
            echo TemplateEngine::View("Pages.Frontend.Articles.view",['article'=>$article->first(),"count"=>$count,"url"=>$url,"likes"=>$likes,"Auth"=>$auth,"images"=>$images,"years"=>$years]);
        }
        else
        {
            redirect($url->make("homepage"));
        }


    }


    public function year(ServerRequest $request,$year,Url $url)
    {
        $articles = Article::whereyear("created_at",$year);
        $count = $articles->count();
        $pages = new LaravelPaginator('2','p');
        $articles = $pages->paginate($articles);
        $links = $pages->page_links();
        $years = Article::selectRaw('year(created_at) year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
        $users = User::all();
        echo TemplateEngine::View("Pages.Frontend.Articles.index",["pages"=>$pages,"count"=>$count,"users"=>$users,"url"=>$url,"articles"=>$articles,"links"=>$links,"years"=>$years]);


    }

}