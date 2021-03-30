<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\Profile;
use App\Http\Models\User;
use DateTime;
use MiladRahimi\PhpRouter\Url;

class BasicInfoController
{

    public function index(Url $url)
    {
        $user = User::find(Auth::id());
        echo BladeEngine::View("Pages.Frontend.Account.basic", ["user" => $user,"url"=>$url]);
    }

    public function store(Url $url)
    {
        $validate = new Validate();
        $dob = new DateTime($validate->Post("dob"));
        //check if the value us empty


        $user = User::find(Auth::id());
        $profile = $user->Profile()->where("user_id", Auth::id())->get();
        $profile->count() == 0 ? $profile = new Profile() : $profile = $profile->first();
        $profile->first_name = $validate->Required("first_name")->Post();
        $profile->last_name = $validate->Required("last_name")->Post();
        $profile->dob = $dob->format("Y-m-d");


        if(Validate::Array_Count(Validate::$values) == true)
        {
            if(Auth::Auth()->RequirePassword($validate->Post("password")) == true)
            {
                $profile->save();
                redirect($url->make("account.home"));
            }
            else
            {
                $error = "Sorry it seems the password you entered does match the database password . please try again";
            }

        }
        else
        {
            $error = "Some fields are missing";
        }

//        leave this here
        echo BladeEngine::View("Pages.Frontend.Account.basic", ["user" => $user,"error"=>$error,"values"=>Validate::$values,"url"=>$url]);

    }


}