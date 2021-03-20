<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\BladeEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Profile;
use App\Http\Models\User;

class AccountController
{

    public function index()
    {
        if(Auth::Loggedin() == true)
        {
            $user = User::find(Auth::id());

            echo BladeEngine::View("Pages.Frontend.Account.index",["user"=>$user]);
        }
        else
        {
            redirect("/auth/login");
        }
    }

}