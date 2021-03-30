<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\BladeEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Profile;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class AccountController
{

    public function index(Url $url)
    {
        if(Auth::Loggedin() == true)
        {
            $user = User::find(Auth::id());

            echo BladeEngine::View("Pages.Frontend.Account.index",["user"=>$user,"url"=>$url]);
        }
        else
        {
            redirect("/auth/login");
        }
    }

}