<?php


namespace App\Http\Controllers;
use App\Http\Functions\BladeEngine;
use App\Http\Models\User;


class UserController
{

    public function index()
    {
        $users = User::where("status","pending")->get();
        foreach ($users as $user)
        {
            echo $user->email . " | <a href='/auth/register/delete/".$user->id."'>Delete User</a><br>";
        }
    }


}