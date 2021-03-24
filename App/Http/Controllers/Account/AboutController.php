<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\ImageManager\Images;
use App\Http\Models\Profile;
use App\Http\Models\User;
use Symfony\Contracts\Service\Attribute\Required;

class AboutController
{

    public function index()
    {
        $user = User::find(Auth::id());
        echo BladeEngine::View("Pages.Frontend.Account.About", ["user" => $user]);
    }

    public function store()
    {
        $validate = new Validate();

        $user = User::find(Auth::id());
        $profile = $user->Profile()->where("user_id", Auth::id())->get();
        $profile->count() == 0 ? $profile = new Profile() : $profile = $profile->first();
        $profile->about = $validate->Post("about");

//        leave this here
        if(Auth::Auth()->RequirePassword($validate->Required("password")->Post()) == true)
        {

                $profile->save();
                redirect("/account");


        }
        else
        {
            Validate::$error = " password empty or does not match";
        }


        echo BladeEngine::View("Pages.Frontend.Account.About", ["user" => $user, "error" => Validate::$error, "values" => Validate::$values]);

    }


}