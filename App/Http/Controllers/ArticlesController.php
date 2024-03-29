<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
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

    public function index(Url $url, Validate $validate)
    {


           $articles = Article::orderBy("created_at","desc");
           $count = $articles->count();
           $pages = new LaravelPaginator('5','page');
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
        $years = Article::selectRaw('year(created_at) year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
        $count = $article->count();
        if(($count == 1))
        {

//            $date = new \DateTime($article->first()->created_at);
            echo TemplateEngine::View("Pages.Frontend.Articles.view",['article'=>$article->first(),"count"=>$count,"url"=>$url,"likes"=>$likes,"Auth"=>$auth,"years"=>$years]);
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