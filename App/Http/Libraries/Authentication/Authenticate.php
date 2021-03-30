<?php


namespace App\Http\Libraries\Authentication;

use App\Http\Functions\BladeEngine;
use App\Http\Libraries\Emails\Authentication;
use App\Http\Models\User;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Authenticate extends Auth
{

//end requests

    public function __construct()
    {
        $this->remmeber = 0;
    }

//    Pre validation

    public static function ValidateEmail($email)
    {
        return User::where("email", $email)->get()->count();
    }


    public static function ValidateUser($username)
    {
        return User::where("username", $username)->get()->count();
    }


//End Prevalidation

// Registration


    public static function InsertTwoFactorAuth($code)
    {

        isset($_SESSION['id']) ? $auth = $_SESSION['id'] : $auth = $_COOKIE['id'];
        $user = User::where("id", $auth)->get()->first();
        if ($code == $user->TwoFactorAuth->code) {
            Sessions::Create("RequireTfa", false);
            header("location:/profile");
            echo  "Approved";
        } else {
            self::$errmessage = "The Code you entered is incorrect";
        }

    }




    public function ResetPassword($id, $hex)
    {

        $result = User::where("id", $id)->get();
        $user = $result->first();
        $count = $result->count();
        if ($count == 1) {
            if ($user->TwoFactorAuth->hex == $hex) {
                self::$ResetApproved = true;
            }
        } else {
            echo "no user found";
        }
        return $this;
    }



    public function Register($redirect = null)
    {
        $user = new User();
        if (self::$withuser == true) {
            $user->username = self::$username;
        }
        if (self::$withemail == true) {
            $user->email = self::$email;
        }
        if (self::$withpassword == true) {
            $user->password = self::$password;
        }

        $user->save();
        self::$id = $user->id;
//        if ((is_null($redirect)) || ($redirect == null)) {
//            header("location:/auth/register/success");
//        } else {
//            header("location:$redirect");
//        }
        return $this;
    }

    public function AllowRemember($remmember)
    {
        $this->remmeber = $remmember;
        return $this;
    }

    public function Login($username = null, $password = null)
    {

        $users = User::where("username", $username)->orwhere("email", $username)->get();
        $user = $users->first();
        if ($users->count() == 1) {

//            Check if the password matches the database password
            if ($this->PasswordVerify($password, $user->password)) {
//                Generate the cookies;
                if ($this->remmeber == 1) {
                    Sessions::Destroy("id");
                    Cookies::Create("id", $user->id)->Days(7)->Http(true)->Save();
                }
                else {
//                We Instantiate session id
                    Cookies::Destroy("id")->Days(365)->Save();
                    Sessions::Create("id", $user->id);
                }

//               Generate CSRF Token
                Csrf::GenerateToken($user->id);
                self::$redirect = true;

//                Send The TFA Login to the email;
//                if($user->two_factor_auth == 1)
//                {
//                    $results = TwoFactorAuth::CountAuths($user->id);
//                    $results == 0 ? TwoFactorAuth::GenerateCode($user->id) : TwoFactorAuth::UpdateTwoFactorAuth($user->TwoFactorAuth->id);
//                    Authentication::TwoFactor($user->email, TwoFactorAuth::__getCode());
//                    Sessions::Create("RequireTfa",true);
//                    Authenticate::$redirect = true;
//                }
//                else
//                {
//                    Sessions::Create("RequireTfa",false);
//                    self::$redirect = true;
//                }

            } else {
                self::$errmessage = "Whoa!! :( it Looks Like the Password you typed doesnt match our Records";
            }
//            Return user doesnt exisit
        } else {
            self::$errmessage = "Sorry the Detiails you are looking for cannot be found in our records";
        }

        return $this;

    }

//    end login script

//    Reset Passwords

    public function PasswordVerify($password, $hash = null)
    {
        if (is_null($hash)) {
            $hash = self::$password;
        }
        return password_verify($password, $hash);
    }
}