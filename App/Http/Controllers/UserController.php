<?php


namespace App\Http\Controllers;
use App\Http\Functions\BladeEngine;
use App\Http\Models\User;


class UserController
{

    public function index()
    {

        $user = User::find(8);
        echo $user->username;
        echo "Csrf token is : " . $user->Token->key;
    }


}