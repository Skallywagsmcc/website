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
        $charters = Charter::orderBy("id","DESC")->get();
        echo TemplateEngine::View("Pages.Frontend.Charters.index",["url"=>$url,"charters"=>$charters]);


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