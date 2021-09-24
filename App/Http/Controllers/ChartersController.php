<?php


namespace App\Http\Controllers;

use App\Http\Functions\TemplateEngine;
use App\Http\Models\Charter;
use App\Http\Models\Likes;
use App\Libraries\LikesManager\LikeManager;
use Carbon\Carbon;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;

class ChartersController
{

    public function index(Url $url,Auth $auth)
    {
        $count = Charter::all()->count();
      $latest = Charter::orderBy("id","Desc")->limit(1)->get()->first();
        $charters = Charter::whereraw("id","<",$latest->id)->get();

        echo TemplateEngine::View("Pages.Frontend.Charters.index",["url"=>$url,"count"=>$count,"charters"=>$charters,"latest"=>$latest]);


    }

    public function show($slug,Url $url)
    {
        $charter = Charter::where("slug","$slug")->get()->first();
        $sidebar = Charter::all();
        $likes = new LikeManager();
       echo TemplateEngine::View("Pages.Frontend.Charters.view",["url"=>$url,"charter"=>$charter,"sidebar"=>$sidebar,"likes"=>$likes]);
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}