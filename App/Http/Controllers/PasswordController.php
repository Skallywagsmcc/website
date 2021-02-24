<?php


namespace App\Http\Controllers;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Models\User;

class PasswordController
{

    public function store()
    {
        $validate = new Validate();
        
      
        $user = User::find($validate->post("id"));
        $user->status = "complete";
        $user->expires = false;

      
        if($validate->data == false)
        {

        }
        else
        {
            if($user->password == $confirm)
            {
//                Password hasing goes here
            }
            else
            {
                $alert = "Passwords do not match";
            }
        }

        echo BladeEngine::View("Pages.Auth.Register.Passwords",["validate"=>$validate->values,"alert"=>$alert,"user"=>$user]);
        
    }


}