<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Article;
use App\Http\Models\User;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class ArticleController
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

    public function view($slug, Url $url)
    {
        $article = Article::where("slug",$slug)->get();
        $count = $article->count();
        if(($count == 1))
        {
            $images = $article->first()->images()->where("article_id",$article->first()->id)->get();

            $date = new \DateTime($article->first()->created_at);
            echo TemplateEngine::View("Pages.Frontend.Articles.view",['article'=>$article->first(),"count"=>$count,"url"=>$url,"date"=>$date,"images"=>$images]);
        }
        else
        {
            redirect($url->make("homepage"));
        }




    }


}