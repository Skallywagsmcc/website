<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Category;
use App\Http\Models\Page;
use App\Http\Models\User;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class PageController
{

    public function index($category , Url $url)
    {
       $category = Category::where("slug",$category)->get();


       if($category->count() == 1)
       {
           $category = $category->first();
           $articles = $category->page()->where("category_id",$category->id);
           $count = $articles->count();
         $sql =  $articles;
           $pages = new LaravelPaginator('1','p');
           $rows = $pages->paginate($sql);
           $links = $pages->page_links();

           $users = User::all();
        echo TemplateEngine::View("Pages.Frontend.Articles.index",["count"=>$count,"category"=>$category,"users"=>$users,"url"=>$url,"articles"=>$rows,"links"=>$links]);
       }
    }

    public function search($category, ServerRequest $request,Url $url)
    {

        $keyword = $request->getQueryParams()['keyword'];
        $category = Category::where("slug",$category)->get();
        $category = $category->first();
        $articles = $category->page()->where("title","LIKE","%".$keyword."%");
        $count = $articles->count();
        $sql =  $articles;
        $pages = new LaravelPaginator('10','p');
        $rows = $pages->paginate($sql);
        $links = $pages->page_links();
        echo $count;

        foreach($rows as $page)
        {
            echo $page->title;
        }

//        $users = User::all();
//        echo TemplateEngine::View("Pages.Frontend.Articles.index",["count"=>$count,"category"=>$category,"users"=>$users,"url"=>$url,"articles"=>$rows,"links"=>$links]);
    }


    public function view($slug, Url $url)
    {
        $article = Page::where("slug",$slug)->get();
        $count = $article->count();
        $date = new \DateTime($article->first()->created_at);
        echo TemplateEngine::View("Pages.Frontend.Articles.view",['article'=>$article->first(),"count"=>$count,"url"=>$url,"date"=>$date]);
    }


}