<?php


namespace App\Http\Controllers;


use App\Http\Functions\BladeEngine;
use App\Http\Models\Page;
use App\Http\Models\User;

class PageController
{

    public function index()
    {
        $articles = Page::all();
        $users = User::all();
        echo BladeEngine::View("Pages.Frontend.Articles.index",["articles"=>$articles,"users"=>$users]);
    }

    public function view($slug)
    {
        $article = Page::where("slug",$slug)->get();
        $count = $article->count();
        echo BladeEngine::View("Pages.Frontend.Articles.view",['article'=>$article->first(),"count"=>$count]);
    }


}