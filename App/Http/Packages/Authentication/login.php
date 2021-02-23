<?php


namespace App\Http\Packages\Authentication;
use App\Http\Packages\Authentication\TwoFactorAuthentication as TwoFa;


use App\Http\Models\User;

class login
{
    public $username;
    public $password;

    public $user;
    public $count;
    public $ValidUser;
    public $ValidPassword;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        $this->IsValidUser();

    }




    public function IsValidUser()
    {
        $results = User::where("username", $this->username)->orwhere("email", $this->username)->get();
        $this->user = $results->first();
        $this->count = $results->count();
        return $this;

    }



    public function AllowCookies($remember)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!isset($_COOKIE['id']))
            {
                unset($_SERVER['id']);
                Cookies::Create("id",$this->user->id,"365");
//                setcookie("id",$this->user->id,time()+3600*24*7,"/",".". $_SERVER['HTTP_HOST']);
                echo "logged in with a cookie";
            }
        }
    }


    public function authenticate()
    {
        if ($this->count == 1) {
            if ($this->VerifyPw() == true) {
                $this->ProcessLogin();
            } else {
                echo "Passwords do not match";
            }

        } else {
            echo "user not found";
        }
        return $this;
    }

    public function VerifyPw()
    {
        return password_verify($this->password, $this->user->password);
    }


//Verify password exisits

//Creeate the sessions and initiate a  csrf token

    protected function ProcessLogin()
    {
//        Start here

        if($this->user->tfa == true)
        {
//
            TwoFa::CreateCode($this->user->id);
            echo "Your 2fa code has been generated";
        }
//    Create the Sessions
//        Cookies::Destroy("id",$this->user->id,"365");
//        Sessions::New("id", $this->user->id)->Destroy()->Create();
//        if (Sessions::$loggedin == true) {
//            $tokens = new Tokens();
//            $tokens->GenerateToken($this->user->id);
//        }

//        end here
    }


}