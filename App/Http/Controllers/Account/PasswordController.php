<?php


namespace App\Http\Controllers\Account;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\User;

class PasswordController
{

    public function index()
    {

        echo BladeEngine::View("Pages.Frontend.Account.PasswordChange",["user",$user]);
    }


    public function store()
    {
        $validate = new Validate();
        if(Auth::Auth()->RequirePassword($validate->Post("password")) == true)
        {
            if($validate->Required("newpw")->Post() ==  $validate->Required("confirm")->Post())
            {
                $validate->HasStrongPassword($validate->Post("newpw"));
                if(Validate::$ValidPassword == true)
                {

                    $user = User::find(Auth::id());
                    $user->password = password_hash($validate->Post("newpw"),PASSWORD_DEFAULT);
                    $user->save();
                    redirect("/auth/logout");
                }
                else
                {
                    Validate::$error = "Some requirments are needed for he password field";
                }
            }
            else
            {
                Validate::$error = "New and confirm password doesnt match";
            }

        }
        else
        {
            Validate::$error = "Sorry the Password does not match the database";
        }
        echo BladeEngine::View("Pages.Frontend.Account.PasswordChange",["user",$user,"error"=>Validate::$error]);
    }


}