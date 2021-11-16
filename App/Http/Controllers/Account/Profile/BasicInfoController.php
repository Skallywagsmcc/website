<?php


namespace App\Http\Controllers\Account\Profile;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Profile;
use App\Http\Models\User;
use DateTime;
use MiladRahimi\PhpRouter\Url;

class BasicInfoController
{

    public $first_name;
    public $last_name;
    public $dob;
    public $password;

    public function __construct(Validate $validate)
    {
        $this->first_name = $validate->Post("first_name");
        $this->last_name = $validate->Post("last_name");
        $this->dob = $validate->Post("dob");
        $this->password = $validate->Post("password");
    }

    public function index(Url $url, Auth $auth)
    {

        $user = User::find($auth->id());
        echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.basic", ["user" => $user, "url" => $url]);
    }

    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {
        if ($csrf->Verify() == true) {
            $dob = new DateTime($this->dob);
            //check if the value us empty

            $validate->AddRequired(["first_name", "last_name"]);

            if ($validate->Allowed() == false) {
                $error = "Required fields are missing";
                $required = $validate->is_required;
            } elseif ($auth->RequirePassword($this->password) == false) {
                $error = "The Password you hae entered could not be found in our database! Please try again.";
            } elseif ($validate->HasStrongPassword($this->password) == false) {
                $error = "The Passsword you have entered does not follow our secure password policy";
            } else {
                $user = User::find($auth->id());
                $profile = $user->Profile()->where("user_id", $auth->id())->get();
                $profile->count() == 0 ? $profile = new Profile() : $profile = $profile->first();
                $profile->first_name = $this->first_name;
                $profile->last_name = $this->last_name;
                $profile->dob = $dob->format("Y-m-d");
                $profile->save();
                    redirect($url->make("account.home"));
            }

//        leave this here
            echo TemplateEngine::View("Pages.Backend.UserCp.Account.Profile.basic", ["user" => $user, "error" => $error,"required"=>$required,"url" => $url,"post"=>$this]);
        }
    }

}