<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\TemplateEngine;
use mbamber1986\Authclient\Auth;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    public function index(Url $url, Auth $auth)
    {
        $user = User::where("id", $auth->id())->get();
        /*
         *This section is intended to be blank
         * but rather than leaving a blank page
         * anyone who accesses /Profile will
         * be redirected to either there logged in profile page
         * or the login page.*/

//        check if user is found

        if($user->count() == 1)
        {
            redirect($url->make("profile.view",["username"=>$user->first()->username]));
        }
        else
        {
            redirect($url->make("login"));
        }

    }

    public function show($username, Url $url)
    {
        $user = User::where("username", $username)->get();
        $count = $user->count();
        $user = $user->first();
        if ($count == 1) {
            echo TemplateEngine::View("Pages.Frontend.Profile.index", ["user" => $user, "url" => $url]);
        } else {
            echo "Profile not found";
        }

    }

}