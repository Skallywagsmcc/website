<?php


namespace App\Http\Libraries\Authentication;

use App\Http\Models\User;

class Authenticate extends Auth
{

//end requests

    public function __construct()
    {
        $this->remember = 0;
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
        return $this;
    }

    public function AllowRemember($remember)
    {
        $this->remember = $remember;
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
                if ($this->remember == 1) {
                    Sessions::Destroy("id");
                    Cookies::Create("id", $user->id)->Days(7)->Http(true)->Save();
                } else {
//                We Instantiate session id
                    Cookies::Destroy("id")->Days(365)->Save();
                    Sessions::Create("id", $user->id);
                }

//               Generate CSRF Token
                $csrf = new Csrf();
                $csrf->GenerateToken($user->id);
                self::$redirect = true;
                /*
                 * Deleted Two Factor Auth from this section 03/04/2021
                 * Added as middleware option
                */
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