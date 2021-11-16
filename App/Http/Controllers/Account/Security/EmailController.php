<?php


namespace App\Http\Controllers\Account\Security;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class EmailController
{

    public $email;


    public function __construct(Validate $validate)
    {
        $this->email = $validate->Post("email");
    }

    public function index(Url $url, Auth $auth)
    {
        $user = User::find($auth->id());
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.EmailChange", ["user" => $user, "url" => $url]);
    }

    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {

        if ($csrf->Verify() == true) {
            $validate->AddRequired(["email"]);
            $user = User::find($auth->id());
//            Step 1 validate
            if ($validate->Allowed() == false) {
                $error = "Required fields missing";
                $required = $validate->is_required;
            } elseif ($user->email == $this->email) {
                $error = "This is already your current email";
            } elseif ($auth->RequirePassword($validate->Post("password")) == false) {
                $error = "this does not follow Our secure password Policy";
            } else {
                $user->save();
                redirect($url->make("logout"));
            }

            echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.EmailChange", ["user", $user, "error" => $error, "url" => $url, "post" => $this]);
        }
    }
//Refactor done on 15/11/2021
}