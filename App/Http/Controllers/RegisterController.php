<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class RegisterController
{

    public function index(Url $url)
    {
        $settings = SiteSettings::where("id",1)->get();
//Lock submissions to the form
        echo TemplateEngine::View("Pages.Auth.Register.index",["url"=>$url,"settings",$settings]);
    }

    public function Store(Url $url, Validate $validate)
    {
        /*
         * Step 1: create Account
         *
         *
         * Step 2 : create Profile
         * Step 3 : user_Settings
         *
         * Add Settings Lock Submissions in case of any issues with the system
         * Enable a check to see if registration is locked or not this will need to be modified on the backend
         * */

//       Create  User account account

        $user = new User();
        $user->username = $validate->Required("username")->Post();
        $user->email = $validate->Required("email")->Post();
        $user->password = $validate->Required("password")->Post();
        $user->disable = 1;
        $user->save();
    }


}