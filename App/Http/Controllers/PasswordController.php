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
        $user->password = $validate->post("password");#
        $user->status = "complete";
        $user->expires = false;
        $user->save();
    }


}