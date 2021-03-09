<?php


namespace App\Http\Controllers;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\User;

use App\Http\Libraries\Email;
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
        $user->remember = $validate->Post("remember");
        if ((Authenticate::ValidateUser($user->username) == 1) || (Authenticate::ValidateEmail($user->username) == 1)) {
            if($validate->data == false)
            {
                Authenticate::$errmessage = "Some Fields are Missing";
            }
            else
            {
                Authenticate::Auth()->AllowRemember($user->remember)->Login($user->username,$user->password)->Redirect("/profile");
            }

        } else {
            Authenticate::$errmessage = "Username or email could not be found Please Consider Registering for an account";
        }

        echo BladeEngine::View("Pages.Auth.Login.index", ["user" => $user, "errmessage" => Authenticate::$errmessage,"Required"=>$validate->values]);
    }
}