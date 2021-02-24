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
        echo BladeEngine::View("Pages.Auth.Register.index");
    }


    public function store()
    {
        $validate = new Validate();
        $user = new User();
        $user->email = $validate->Required("email")->Post();
        $user->password = $validate->Required("password")->Post();

    Register::ValidateEmail($user->email)->GeneratePassword($password)->EmailConfirmation()->Redirect("/auth/login");
    }

    public function delete($id)
    {
        $user = User::where("id",$id);
            if($user->get()->count() == 1)
        {
            $user->delete();
        }
            else
        {
            echo "User cannot be found";
        }
    }



}