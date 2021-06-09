<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Article;
use App\Http\Models\User;
use App\Libraries\LikesManager\LikeManager;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class ArticlesController
{

    public function index(Url $url)
    {
           $articles = Article::orderBy("id");
           $count = $articles->count();
           $pages = new LaravelPaginator('1','p');
           $articles = $pages->paginate($articles);
           $links = $pages->page_links();
           $users = User::all();
        echo TemplateEngine::View("Pages.Frontend.Articles.index",["pages"=>$pages,"count"=>$count,"users"=>$users,"url"=>$url,"articles"=>$articles,"links"=>$links]);


    }

    public function view($slug, Url $url,Auth $auth)
    {
        $article = Article::where("slug",$slug)->get();
        $entry_name = baseclass(get_called_class())->getShortName();
        $likes = new LikeManager();
        $count = $article->count();
        if(($count == 1))
        {
            $images = $article->first()->images()->where("entry_name",$entry_name)->where("entry_id",$article->first()->id)->get();

//            $date = new \DateTime($article->first()->created_at);
            echo TemplateEngine::View("Pages.Frontend.Articles.view",['article'=>$article->first(),"count"=>$count,"url"=>$url,"likes"=>$likes,"auth"=>$auth,"images"=>$images]);
        }
        else
        {\
            redirect($url->make("homepage"));
        }


    }


}