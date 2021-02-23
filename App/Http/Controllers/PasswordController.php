<?php


namespace App\Http\Controllers;


use App\Http\Functions\Validate;
use App\Http\Models\User;

class PasswordController
{

    public function store()
    {
        $validate = new Validate();
        
      
        $user = User::find($validate->post("id"));
        $user->username = $validate->Required("username")->Post();
        $user->password = $validate->Required("password")->Post();
        $confirm = $validate->Required("confirm")->Post();
        $user->status = "complete";
        $user->expires = false;

      
        if($validate->data == false)
        {
            echo "fields are required";
        }
        else
        {
            if($user->password == $confirm)
            {

            }
            else
            {
                echo "Passwords dont match";
            }
        }
        
        
    }


}