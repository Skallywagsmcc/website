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

    public $username;
    public $email;
    public $password;
    public $confirm;
    public $first_name;
    public $last_name;

    public function __construct(Validate $validate)
    {
        $this->username = $validate->Post("username");
        $this->email = $validate->Post("email");
        $this->password = $validate->Post("password");
        $this->confirm = $validate->Post("confirm");
        $this->first_name = $validate->Post("first_name");
        $this->last_name = $validate->Post("last_name");
    }

    public function index(Url $url)
    {
        /*
         * 1 : lock Submissions
         * Check is Registration is open or closed to the public*/
        $settings = $this->SiteSettings();
        if($settings->get()->count()==1)
        {
            $error = "Settings found";
//            Site Settings found
        }
        else
        {
            redirect("/install");
        }
        echo TemplateEngine::View("Pages.Auth.Register.index", ["url" => $url, "settings" => $this->SiteSettings()->get(),"error"=>$error]);
    }

    public function SiteSettings()
    {
        return SiteSettings::where("id", 1);
    }

    public function Open_registration()
    {
        return $this->SiteSettings()->where("open_registration", 0)->get();
    }

    public function Store(Url $url, Validate $validate)
    {

//        Instantiate the Required fields
        $validate->AddRequired(["username", "email", "password", "confirm", "first_name", "last_name"]);
        if ($this->SiteSettings()->where("lock_submissions", 1)->get()->count() == 1) {
            $error = "Submissions have been locked";
        } else {
//            Continue the Submissions
            if($this->Open_registration()->count() == 1)
            if ($validate->Allowed() == false) {
                print_r($validate->is_required);
            } else {
                echo "All good";
            }
        }


//            if ($this->Open_registration()->count() == 1 or $this->SiteSettings()->get()->first()->lock_submissions == 1) {
//                redirect($url->make("login"));
//            }
//
//
////        Variables
//
//            $pwvals = ["One Lower case", "One upper case", "At lease one number", "less than 8 letters"];
//
////       Create  User account account
//
//            $ue = User::where("username", $this->username)->orwhere("email", $this->email)->get();
//
//            if ($ue->count() == 1) {
//                $error = "username or email already taken Please use another";
//            } else {
//                if ($validate->allowed == false) {
//                    $error = "missing fields";
//                    $rfs = $validate->is_required;
//                } elseif ($password != $confirm) {
//                    $error = "Password does not match";
//                } else {
//                    if ($validate->HasStrongPassword($password) == false) {
//                        $error = "Password Requirements have not been met.";
//                        $required = $pwvals;
//                    } else {
//                        $user = new User();
//                        $user->username = $this->username
//                    $user->email = $this->email
//                    $user->password = password_hash($this->password, PASSWORD_DEFAULT);
//                    $user->disable = 1;
//                    $user->save();
//
//// get user id
//                    $id = $user->id;
//
////        Create Profile
//                    $profile = new Profile();
//                    $profile->user_id = $id;
//                    $profile->first_name = $this->first_name
//                    $profile->last_name = $this->last_name;
//                    $profile->save();
//
//
////        Create User Settings
//
//                    $settings = new UserSettings();
//                    $settings->user_id = $id;
//                    $settings->save();
//
//                    redirect($url->make("login"));
//                }
//                }
//            }
//        }
        echo TemplateEngine::View("Pages.Auth.Register.index", ["url" => $url, "settings", $settings, "error" => $error, "required" => $required, "post" => $validate,
            "rfs" => $rfs, "settings" => $this->SiteSettings()->get(), "or" => $this->Open_registration()]);
    }
}
