<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\User;

class EmailController
{

    public function index()
    {

        echo BladeEngine::View("Pages.Frontend.Account.EmailChange", ["user", $user]);
    }


    public function store()
    {
        $validate = new Validate();
        if (Auth::Auth()->RequirePassword($validate->Post("password")) == true) {


            $user = User::find(Auth::id());
            $user->email = $validate->Required("email")->Post();

            if (Validate::Array_Count(Validate::$values) == false) {
                Authenticate::$errmessage = "Some Fields are Missing";
            } else {
                $user->save();
                redirect("/auth/logout");
            }

        } else {
            Validate::$error = "Sorry the Password does not match the database";
        }
        echo BladeEngine::View("Pages.Frontend.Account.EmailChange", ["user", $user, "error" => Validate::$error]);
    }


}