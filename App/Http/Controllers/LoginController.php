<?php


namespace App\Http\Controllers;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\User;

class LoginController
{

    public function index()
    {
        echo BladeEngine::View("Pages.Auth.Login.index");
    }

    public function store()
    {
        $validate = new Validate();
        $user = new User();
        $user->username = $validate->Required("username")->Post();
        $user->password = $validate->Required("password")->Post();

//        if ((Authenticate::ValidateUser($user->username) == 1) || (Authenticate::ValidateEmail($user->username) == 1)) {
//
//        } else {
//            Authenticate::$errmessage = "Username or email could not be found Please Consider Registering for an account";
//        }
echo $user->username;
        Authenticate::Auth()->WithUser($user->username)->Login();
        echo BladeEngine::View("Pages.Auth.Login.index", ["user" => $user, "errmessage" => Authenticate::$errmessage]);
    }
}