<?php


namespace App\Http\Controllers\Account\Profile;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Profile;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;
use Symfony\Contracts\Service\Attribute\Required;

class AboutController
{
    public $about;
    public $password;

    public function __construct(Validate $validate)
    {
        $this->about = $validate->Post("about");
        $this->password = $validate->Post("password");
    }


    public function index(Url $url, Auth $auth)
    {
        $user = User::find($auth->id());
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.About", ["user" => $user, "url" => $url]);
    }

    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {

        //Refactor done on 15/11/2021
        if ($csrf->Verify() == true) {
            $user = User::find($auth->id());
            $profile = $user->Profile()->where("user_id", $auth->id())->get();
            $profile->count() == 0 ? $profile = new Profile() : $profile = $profile->first();
            $profile->about = $this->about;

//        leave this here
            if($validate->Allowed()==false)
            {
                $error = "Required fields are missing";
                $required = $validate->is_required;
            }
            elseif ($auth->RequirePassword($this->password) == false) {
                $error = "Password does not match our secure password policy";
            } else {
                $profile->save();
                redirect($url->make("backend.home"));
            }

            echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.About", ["url" => $url, "user" => $user, "error" => $error,"required"=>$required,"post"=>$this]);
        }

    }

}