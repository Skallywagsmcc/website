<?php


namespace App\Http\Controllers;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Libraries\Authentication\TwoFactorAuth;
use App\Http\Libraries\Emails\Authentication;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;

class PasswordController
{

    public function index()
    {
       echo BladeEngine::View("Pages.Auth.PasswordReset.index");
    }

    public function request()
    {
        $validate = new Validate();
        $email = $validate->Required("email")->Post();
        $users = User::where("email",$email)->get();
        $user = $users->first();
        if($users->count() == 1)
        {
            $results = TwoFactorAuth::CountAuths($user->id);
            $results == 0 ? TwoFactorAuth::GenerateCode($user->id) : TwoFactorAuth::UpdateTwoFactorAuth($user->TwoFactorAuth->id);
        }
        else
        {
            Authenticate::$errmessage = "the user your are trying to find does not exist";
        }
    $tfa = TwoFactorAuth::ObtainHex($user->id);
        Authentication::ResetPassword($user->email,$user->id,$tfa->hex);

                echo BladeEngine::View("Pages.Auth.PasswordReset.index",["errmessage"=>Authenticate::$errmessage]);
    }



    public function retrieve($id,$hex)
    {
        Authenticate::Auth()->ResetPassword($id,$hex);

//        Check is the reset request was approved
        if(Authenticate::$ResetApproved == true)
        {
            echo BladeEngine::View("Pages.Auth.PasswordReset.newpassword",["errmessage"=>Authenticate::$errmessage,"id"=>$id,"hex"=>$hex]);
        }
        else
        {
            echo BladeEngine::View("Pages.Auth.PasswordReset.index");
        }
    }



    public function store()
    {
        $user = new User();
        $validate = new Validate();
        $user->id = $validate->Post("id");
        $user->password = $validate->Required("password")->Post();
        $user->confirm = $validate->Required("confirm")->Post();

        if($user->password == $user->confirm )
        {
            $validate->HasStrongPassword($user->password);
            if($validate::$ValidPassword == false)
            {
                Authenticate::$errmessage = "The PAsswords do not fit our requirments";
            }
            else
            {
                $user = User::find($user->id);
                if($user->count == 1)
                {
                    echo "User found";
                }
            }
        }
        else
        {
            Authenticate::$errmessage = "Passswords do not match";
        }


            echo  BladeEngine::View("Pages.Auth.PasswordSReset.newpassword",["Requirments"=>Validate::$ShowRequirments]);

//   Will work on this tomorrow : 02/03/2021
    }


}