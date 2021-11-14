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
        $this->email = $validate->Required("email")->Post();
    }

    public function index(Url $url)
    {

        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.EmailChange", ["user", $user,"url"=>$url]);
    }

    public function store(Url $url,Validate $validate, Csrf $csrf,Auth $auth)
    {
        //Todo Implement the $post variable into email veiw and also refactor this code.
        if ($csrf->Verify() == true) {
            if ($auth->RequirePassword($validate->Post("password")) == true) {
                $user = User::find($auth->id());
                $user->email = $this->email;

                if ($validate->Allowed() == false) {
                    $error = "Required fields missing";
                    $required = $validate->is_required;
                } else {
                    if($user->email == $this->email)
                    {
                     $error = "This is already your current email";
                    }
                    else {
                        $user->save();
                        redirect($url->make("logout"));
                    }
                }

            } else {
                $errror = "Sorry the PasswordRequest does not match the database";
            }
            echo TemplateEngine::View("Pages.Backend.UserCp.Account.Security.EmailChange", ["user", $user,"post"=>$this, "error" => $error, "url" => $url]);
        }
    }

}