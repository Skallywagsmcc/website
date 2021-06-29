<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class EmailController
{

    public function index(Url $url)
    {

        echo TemplateEngine::View("Pages.Backend.UserCp.Account.EmailChange", ["user", $user,"url"=>$url]);
    }


    public function store(Url $ur,Validate $validate, Csrf $csrf)
    {
        if ($csrf->Verify() == true) {
            if (Auth::Auth()->RequirePassword($validate->Post("password")) == true) {
                $user = User::find(Auth::id());
                $user->email = $validate->Required("email")->Post();

                if (Validate::Array_Count(Validate::$values) == false) {
                    Authenticate::$errmessage = "Some Fields are Missing";
                } else {
                    $user->save();
                    redirect($url->make("logout"));
                }

            } else {
                Validate::$error = "Sorry the PasswordRequest does not match the database";
            }
            echo TemplateEngine::View("Pages.Backend.UserCp.Account.EmailChange", ["user", $user, "error" => Validate::$error, "url" => $url]);
        }
    }

}