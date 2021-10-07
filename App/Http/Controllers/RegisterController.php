<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\Profile;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use MiladRahimi\PhpRouter\Url;

class RegisterController
{

    public function SiteSettings()
    {
        return SiteSettings::where("id", 1);
    }


    public function Open_registration()
    {
        return $this->SiteSettings()->where("open_registration", 0)->get();
    }


    public function index(Url $url)
    {
        /*
         * 1 : lock Submissions
         * Check is Registration is open or closed to the public*/
        echo TemplateEngine::View("Pages.Auth.Register.index", ["url" => $url, "settings" => $this->SiteSettings()->get(), "or" => $this->Open_registration()]);
    }

    public function Store(Url $url, Validate $validate)
    {


        if ($this->Open_registration()->count() == 1 or $this->SiteSettings()->get()->first()->lock_submissions == 1) {
            redirect($url->make("login"));
        }

        $validate->AddRequired(["username", "email", "password", "confirm", "first_name", "last_name"]);
        /*
         * Step 1: create Account
         * Step 2 : create Profile
         * Step 3 : user_Settings
         *
         * Additional Settings added
         * Add Settings Lock Submissions in case of any issues with the system
         * Enable a check to see if registration is locked or not this will need to be modified on the backend
         * */

//        Variables

        $pwvals = ["One Lower case", "One upper case", "At lease one number", "less than 8 letters"];
        $username = $validate->Post("username");
        $email = $validate->Post("email");
        $password = $validate->Post("password");
        $confirm = $validate->Post("confirm");
        $fn = $validate->Post("first_name");
        $ln = $validate->Post("last_name");

//       Create  User account account

        $ue = User::where("username", $username)->orwhere("email", $email)->get();

        if ($ue->count() == 1) {
            $error = "username or email already taken Please use another";
        } else {
            if ($validate->allowed == false) {
                $error = "missing fields";
                $rfs = $validate->is_required;
            } elseif ($password != $confirm) {
                $error = "Password does not match";
            } else {
                if ($validate->HasStrongPassword($password) == false) {
                    $error = "Password Requirements have not been met.";
                    $required = $pwvals;
                } else {
                    $user = new User();
                    $user->username = $username;
                    $user->email = $email;
                    $user->password = password_hash($password, PASSWORD_DEFAULT);
                    $user->disable = 1;
                    $user->save();

// get user id
                    $id = $user->id;

//        Create Profile
                    $profile = new Profile();
                    $profile->user_id = $id;
                    $profile->first_name = $fn;
                    $profile->last_name = $ln;
                    $profile->save();


//        Create User Settings

                    $settings = new UserSettings();
                    $settings->user_id = $id;
                    $settings->save();

                    redirect($url->make("login"));
                }
            }
        }
        echo TemplateEngine::View("Pages.Auth.Register.index", ["url" => $url, "settings", $settings, "error" => $error, "required" => $required, "post" => $validate,
            "rfs" => $rfs,"settings" => $this->SiteSettings()->get(), "or" => $this->Open_registration()]);
    }


}
