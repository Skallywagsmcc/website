<?php


namespace App\Http\Packages\Authentication;
use App\Http\Packages\Authentication\TwoFactorAuthentication as TwoFa;


use App\Http\Models\User;

class login
{





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