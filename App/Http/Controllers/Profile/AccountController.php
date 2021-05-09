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
            $profile = $user->Profile()->where("user_id",$user->id)->get();
            if($profile->count() == 0)
            {
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->save();
                redirect($url->make("account.home"));
            }
            $dob = new \DateTime("".$user->Profile->dob."");
            echo TemplateEngine::View("Pages.Frontend.Account.index",["user"=>$user,"url"=>$url,"dob"=>$dob->format("d/m/Y")]);
        }
        else
        {
            redirect("/auth/login");
        }
    }

}