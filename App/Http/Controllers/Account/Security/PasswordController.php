<?php


namespace App\Http\Controllers\Account\Security;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\User;
use MiladRahimi\PhpContainer\Tests\Classes\A;
use MiladRahimi\PhpRouter\Url;

class PasswordController
{

    public function index(Url $url)
    {

        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.PasswordChange", ["user", $user, "url" => $url]);
    }


    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {
        if ($csrf->Verify() == true) {
            if ($auth->RequirePassword($validate->Post("password")) == true) {
                if ($validate->Required("newpw")->Post() == $validate->Required("confirm")->Post()) {
                    $validate->HasStrongPassword($validate->Post("newpw"));
                    if (Validate::$ValidPassword == true) {

                        $user = User::find($auth->id());
                        $user->password = password_hash($validate->Post("newpw"), PASSWORD_DEFAULT);
                        $user->save();
                        redirect($url->make("logout"));
                    } else {
                        Validate::$error = "Some requirments are needed for he password field";
                    }
                } else {
                    Validate::$error = "New and confirm password doesnt match";
                }

            } else {
                Validate::$error = "Sorry the PasswordRequest does not match the database";
            }
            echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.PasswordChange", ["user", $user, "error" => Validate::$error, "url" => $url]);
        }
    }
}