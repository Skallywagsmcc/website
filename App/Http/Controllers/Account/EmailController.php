<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class EmailController
{

    public function index(Url $url)
    {

        echo TemplateEngine::View("Pages.Frontend.Account.EmailChange", ["user", $user,"url"=>$url]);
    }


    public function store(Url $url)
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
        echo TemplateEngine::View("Pages.Frontend.Account.EmailChange", ["user", $user, "error" => Validate::$error,"url"=>$url]);
    }


}