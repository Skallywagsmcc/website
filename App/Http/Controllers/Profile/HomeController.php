<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public function index(Url $url)
    {
        echo "coming soon";
    }

    public function show($username,Url $url)
    {
        $user = User::where("username", $username)->get();
        $count = $user->count();
        $user = $user->first();
        if($count == 1)
        {
            echo TemplateEngine::View("Pages.Frontend.Profile.index", ["user" => $user,"url"=>$url]);
        }
        else
        {
            echo "Profile not found";
        }

    }

}