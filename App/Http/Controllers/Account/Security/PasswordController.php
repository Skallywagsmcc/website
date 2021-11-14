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

    public $password;
    public $newpw;
    public $confirm;

    public function __construct(Validate $validate)
    {

        $this->password = $validate->Post("password");
        $this->newpw = $validate->Post("newpw");
        $this->confirm = $validate->Post("confirm");
    }

    public function index(Url $url)
    {

        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.PasswordChange", ["user", $user, "url" => $url]);
    }


    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {
        //todo looks messy needs refactor , Add Required fields page
        if ($csrf->Verify() == true) {
            if ($auth->RequirePassword($validate->Post("password")) == true) {
                if ($this->newpw == $this->confirm) {
                    if ($validate->HasStrongPassword($this->newpw) == true) {
                        $user = User::find($auth->id());
                        $user->password = password_hash($this->newpw, PASSWORD_DEFAULT);
                        $user->save();
                        redirect($url->make("logout"));
                    } else {
                        $error = "Some requirments are needed for he password field";
                    }
                } else {
                    $error = "New and confirm password doesnt match";
                }

            } else {
                $error = "Sorry the PasswordRequest does not match the database";
            }
            echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.PasswordChange", ["user", $user, "error" => $error, "url" => $url]);
        }
    }
}