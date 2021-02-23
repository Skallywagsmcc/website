<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;
use App\Http\Models\User;

class UserController
{
    public function index()
    {
        $users = User::all();
        echo BladeEngine::View("Pages.Admin.Users.index",["users"=>$users]);
    }

}