<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Models\Profile;
use App\Http\Models\RegisterRequest;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use App\Http\Models\UserSettings;
use Migrations\Register_Request;
use MiladRahimi\PhpRouter\Url;

class RegisterController
{

    public $username;
    public $email;
    public $password;
    public $confirm;
    public $first_name;
    public $last_name;
    public $status;
    public $token;
    public $showform;

    public function __construct(Validate $validate)
    {
        $this->username = $validate->Post("username");
        $this->email = $validate->Post("email");
        $this->password = $validate->Post("password");
        $this->confirm = $validate->Post("confirm");
        $this->first_name = $validate->Post("first_name");
        $this->last_name = $validate->Post("last_name");
        $this->token = $validate->Post("token");
        $this->status = false;
        $this->showform = false;
    }

    public function index(Url $url, $token = null)
    {
        $settings = $this->SiteSettings();
//        Add Lockout


        if ($settings->where("open_registration", 0)->count() == 1) {
            if (!is_null($token)) {
                $request = RegisterRequest::where("token", $token)->get();
                if ($request->count() == 1) {
                    $request = $request->first();
                    $this->showform = true;
                } else {
                    $error = "User Token Could not be found";
                    $this->showform = false;
                }
            } else {
                $error = "Registration is closed";
                $this->showform = false;
            }
        } else {
            $this->status = true;
            $this->showform = true;
            echo "we can register";
        }

        echo TemplateEngine::View("Pages.Auth.Register.index", ["url" => $url, "settings" => $this->SiteSettings()->get(), "error" => $error, "showform" => $this->showform, "request" => $request]);
    }

    public function SiteSettings()
    {
        return SiteSettings::where("id", 1);
    }

    public function Store(Url $url, Validate $validate)
    {

        $validate->AddRequired(["username", "email", "password", "confirm", "first_name", "last_name"]);
        $user = User::where("username",$this->username)->orwhere("email",$this->email)->get();
        if ($this->SiteSettings()->where("lock_submissions", 1)->count() == 1) {
            redirect($url->make("register"));
            exit();
        }

        if ($validate->allowed() == false) {
            $error = "Required fields";
            $required = $validate->is_required;
//            $this->status = false;
            $this->showform = true;
        } elseif ($this->password != $this->confirm) {
            $error = "Password DOes not match";
            $this->showform = true;
        }
        elseif($validate->HasStrongPassword($this->password) == false)
        {
            $error = "Password does not match our Secure Password Policy";
            $this->showform = true;
        }
        elseif($user->count()==1)
        {
            $user = $user->first();
            if($user->email == $this->email)
            {
                $error = "email Has Already been used";
                $this->showform = true;
            }
            elseif($user->username == $this->username)
            {
                $error = "username has been taken";
            }
        }
        elseif($this->username == $this->email)
        {
            $error = "Username and Email cannot be the same";

            $this->showform = true;
        }

        else {
            if ($this->SiteSettings()->where("open_registration", "0")->count() == 1) {
                $request = RegisterRequest::where("token", $this->token)->get();
                if ($request->count() == 1) {
                    $status = true;
                }
                else
                {
                    $error = "User token Not found";
                }
            } else {
                echo "this is setup if the account is not locked";
            }
        }

        if($status == true)
        {
            //                Create user account;
                $user = new User();
                $user->username = $this->username;
                $user->email = $this->email;
                $user->password = password_hash($this->password, PASSWORD_DEFAULT);
//                verification of account required disable set to 1;
                $user->disable = 0;
                $user->save();

// get user id
                $id = $user->id;

//        Create Profile
                $profile = new Profile();
                $profile->user_id = $id;
                $profile->first_name = $this->first_name;
                $profile->last_name = $this->last_name;
                $profile->save();


//        Create User Settings

                $settings = new UserSettings();
                $settings->user_id = $id;
                if($settings->save())
                {
                    RegisterRequest::where("email",$this->email)->where("token",$this->token)->delete();
                    redirect($url->make("login"));
                }


        }

        echo TemplateEngine::View("Pages.Auth.Register.index", ["url" => $url, "settings", $settings, "error" => $error, "token" => $token, "required" => $required, "post" => $this, "showform" => $this->showform]);

////                Create user account;
//                $user = new User();
//                $user->username = $this->username;
//                $user->email = $this->email;
//                $user->password = password_hash($this->password, PASSWORD_DEFAULT);
////                verification of account required disable set to 1;
//                $user->disable = 0;
//                $user->token = null;
//                $user->save();
//
//// get user id
//                $id = $user->id;
//
////        Create Profile
//                $profile = new Profile();
//                $profile->user_id = $id;
//                $profile->first_name = $this->first_name;
//                $profile->last_name = $this->last_name;
//                $profile->save();
//
//
////        Create User Settings
//
//                $settings = new UserSettings();
//                $settings->user_id = $id;
//                $settings->save();
//
//                redirect($url->make("login"));
//            }

    }


}
