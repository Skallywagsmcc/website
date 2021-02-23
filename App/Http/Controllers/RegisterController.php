<?php


namespace App\Http\Controllers;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Models\User;
use App\Http\Packages\Authentication\Register;

class RegisterController
{

    public function index()
    {
        echo BladeEngine::View("Pages.Auth.Register");
    }
    public function store()
    {
        $validate = new Validate();
        $user = new User();
        $user->username = $validate->Required("username")->Post();
        $user->email = $validate->Required("email")->Post();
        $user->password = $validate->Required("password")->Post();
        $confirm = $validate->Required("confirm")->Post();
        if($validate->data == false)
        {

            Register::ValidateEmail($user->email)->View("Pages.Auth.Register.Passwords",["id"=>Register::$id]);
            if(Register::$ValidEmail == true)
            {
                $register = new Register();
                $register->redirect("/auth/login");
            }

        }
    }





}