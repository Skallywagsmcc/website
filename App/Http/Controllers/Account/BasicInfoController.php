<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\User;

class BasicInfoController
{

    public function index()
    {
        $user = User::find(Auth::id());
        echo BladeEngine::View("Pages.Frontend.Account.basic",["user"=>$user]);
    }

    public function store()
    {
        $validate = new Validate();
        if(Auth::auth()->RequirePassword($validate->Post("password")) == true)
        {
            $user = User::find(Auth::id());
            $user->username = "tom";
            $user->attatch("Profile","first_name") = "timmy";
            $user->save();
            echo "username is " . $user->first_name;
        }
        else
        {
            echo "your failed";
        }
    }


}