<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Article;
use App\Http\Models\Likes;
use App\Http\Models\User;
use App\Libraries\LikesManager\Base;
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

    public function view($slug, Url $url,Auth $auth,Base $likes)
    {
        $article = Article::where("slug",$slug)->get();
        $entry_name = baseclass(get_called_class())->getShortName();
        $likes = $likes->GetLikes($entry_name,$article->first()->id);

        $count = $article->count();
        if(($count == 1))
        {
//            $images = $article->first()->images()->where("article_id",$article->first()->id)->get();

            $date = new \DateTime($article->first()->created_at);
            echo TemplateEngine::View("Pages.Frontend.Articles.view",['article'=>$article->first(),"count"=>$count,"url"=>$url,"date"=>$date,"likes"=>$likes,"entry_name"=>$entry_name,"btn"=>$btn]);
        }
        else
        {
            redirect($url->make("homepage"));
        }




    }


}