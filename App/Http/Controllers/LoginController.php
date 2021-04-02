<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Libraries\Authentication\Sessions;
use App\Http\Models\User;

use App\Http\Packages\Authentication\Cookies;
use MiladRahimi\PhpRouter\Url;

class LoginController
{

    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Auth.Login.index",["url"=>$url]);
    }

    public function store(Url $url)
    {
        $validate = new Validate();
        $user = new User();
        $user->username = $validate->Required("username")->Post();
        $user->password = $validate->Required("password")->Post();
        $user->remember = $validate->Post("remember");
        if ((Authenticate::ValidateUser($user->username) == 1) || (Authenticate::ValidateEmail($user->username) == 1)) {
            if(Validate::Array_Count(Validate::$values) == false)
            {
                Authenticate::$errmessage = "Some Fields are Missing";
            }
            else {
                Authenticate::Auth()->AllowRemember($user->remember)->Login($user->username, $user->password)->Redirect($url->make("profile.home",["username"=> User::find(Auth::id())->username]));
                $_SESSION['tfa_approved'] = 0;
            }
        } else {
            Authenticate::$errmessage = "Username or email could not be found Please Consider Registering for an account";
        }
        echo TemplateEngine::View("Pages.Auth.Login.index",["user"=>$user,"values"=>$validate::$values,"error"=>Authenticate::$errmessage,"url"=>$url]);
    }

    public function logout(Url $url)
    {
        if((isset($_SESSION['id'])) || (isset($_COOKIE['id'])))
        {
            Sessions::Destroy("id");
            Sessions::Destroy("tfa_approved");
            \App\Http\Libraries\Authentication\Cookies::Destroy("id")->Save();
            redirect($url->make("login"));
        }

    }

}