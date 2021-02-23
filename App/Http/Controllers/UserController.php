<?php


namespace App\Http\Controllers;
use App\Http\Functions\BladeEngine;
use App\Http\Models\User;


class UserController
{

    public function index()
    {
        $users = User::all();
        foreach ($users as $user)
        {
            echo $user->username;
        }
    }


}