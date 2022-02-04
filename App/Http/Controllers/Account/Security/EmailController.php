<?php


namespace App\Http\Controllers\Account\Security;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\traits\Activity_log;
use App\Http\traits\Users;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class EmailController
{

    use Users;
    use Activity_log;
    public $email;
    public $error;
    public $password;


    public function __construct(Validate $validate)
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $this->email = $validate->Post("email");
            $this->password = $validate->Post("password");
        }
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
            $user = $this->findusers($auth->id())->first();
//            Step 1 validate
            if ($validate->Allowed() == false) {
                $error = "Required fields missing";
                $required = $validate->is_required;
            }
            elseif ($auth->RequirePassword($this->password) == false) {
                $error = "this does not follow Our secure password Policy";
            }
            elseif($this->userexists($this->email) == true)
            {
                $error = "Invalid Request : Email Address exists";
            }
            elseif ($user->email == $this->email) {
                $error = "This is already your current email";
            } else {
                $user->email = $this->email;
                $user->save();
                $this->addurl("http://".$_SERVER['HTTP_HOST'].$url->make("security.email.home"))->newactivity("email","update");
                redirect($url->make("logout"));
            }
        }
            else
            {
                $error = "Csrf Token does not match";
            }
            echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.EmailChange", ["user", $user, "error" => $error, "url" => $url, "post" => $this]);

    }
//Refactor done on 15/11/2021
}