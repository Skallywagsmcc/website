<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class PasswordController
{

    public function index(Url $url)
    {

        echo TemplateEngine::View("Pages.Frontend.Account.PasswordChange",["user",$user,"url"=>$url]);
    }


    public function store(Url $url, Validate $validate,Csrf $csrf)
    {
        if($csrf->Verify()==true) {
            if (Auth::Auth()->RequirePassword($validate->Post("password")) == true) {
                if ($validate->Required("newpw")->Post() == $validate->Required("confirm")->Post()) {
                    $validate->HasStrongPassword($validate->Post("newpw"));
                    if (Validate::$ValidPassword == true) {

                        $user = User::find(Auth::id());
                        $user->password = password_hash($validate->Post("newpw"), PASSWORD_DEFAULT);
                        $user->save();
                        redirect("/Auth/logout");
                    } else {
                        Validate::$error = "Some requirments are needed for he password field";
                    }
                } else {
                    Validate::$error = "New and confirm password doesnt match";
                }

            } else {
                Validate::$error = "Sorry the PasswordRequest does not match the database";
            }
            echo TemplateEngine::View("Pages.Frontend.Account.PasswordChange", ["user", $user, "error" => Validate::$error, "url" => $url]);
        }
    }


}