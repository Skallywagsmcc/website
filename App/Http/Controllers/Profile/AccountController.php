<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\TemplateEngine;
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
//            echo $user->Profile->dob;
            $dob = new \DateTime("".$user->Profile->dob."");
            echo TemplateEngine::View("Pages.Frontend.Account.index",["user"=>$user,"url"=>$url,"dob"=>$dob->format("d/m/Y")]);
        }
        else
        {
            redirect("/auth/login");
        }
    }

}